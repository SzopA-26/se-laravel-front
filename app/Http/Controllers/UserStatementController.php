<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Package;
use App\User;
use App\UserStatement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatementController extends Controller
{
    public function myStatements($id,$statements=null,$start_date=null,$end_date=null){
        $user = User::findOrFail(Auth::id());
        $n_packages = Package::where('room_id',$id)->where('status','รอรับของ')->count();
        $bill_this_month = Bill::where( 'activated_at', '<=', Carbon::today())->where('status','รอชำระ')->where('room_id','=',$user->room_id)->count();

        if ($statements === null) {
            $statements = UserStatement::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }
        return view('userStatements.showUserStatement',['statements' => $statements,'room' => $id,'user' => $user,'c' => $n_packages,'start_date' => $start_date,'end_date' => $end_date,'bill_this_month'=>$bill_this_month]);
    }

    public function statementDayFix($id,Request $request){
        $start = Carbon::create($request->input('start'));
        $end = Carbon::create($request->input('end'))->addDays(1);
        $statements = UserStatement::where('user_id',Auth::id())->whereBetween('created_at',[$start,$end])->get();
        return $this->myStatements($id,$statements,$start->toDateString(),$end->subDay(1)->toDateString());
    }

    public function allStatement($id){
        return $this->myStatements($id);
    }
}
