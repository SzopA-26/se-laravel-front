<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BookingRequest;
use App\Building;
use App\Report;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today =Carbon::today();
        $bills = Bill::where( 'activated_at', '<=', $today)->where('status','บิลใหม่')->get();

        return view('receipts.index',['bills' => $bills]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function billCreateShowReport($id){
        $bill = Bill::findOrFail($id);
        $reports = $bill->room->reports;
        return view('receipts.create',['reports' => $reports,'bill' => $bill]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill_id = $request->input('bill_id');
        $bill = Bill::findOrFail($bill_id);
        $price = $request->input('price');
        $water_unit = $request->input('w_unit');
        $electric_unit = $request->input('e_unit');
        $w_rate = $bill->room->building->water_rate;
        $e_rate = $bill->room->building->electric_rate;

        $totalPrice = $price + ($w_rate * $water_unit) + ($e_rate * $electric_unit);

        $bill->user_id = Auth::id();
        $bill->water_unit = $water_unit;
        $bill->electric_unit = $electric_unit;
        $bill->total_price = $totalPrice;
        $bill->status = 'รอชำระ';
        $bill->save();



        return redirect()->route('receipts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        $user = User::findOrFail(Auth::id());
        $req = BookingRequest::get()->where('room_id', $id)->first();
//        dd($request);
        $bill = Bill::all()->where('room_id',$user->room_id)->where('status','รอชำระ')->first();
        return view('receipts.show',['bill' => $bill,'user' => $user , 'req'=> $req, 'room'=> $user->room_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function paid(Request $request){
        $bill_id = $request->input('bill_id');
        $old_bill = Bill::findOrFail($bill_id);
        $old_bill->user_paid = Auth::id();
        $old_bill->status = "ชำระแล้ว";
        $old_bill->save();

        $user = User::findOrFail(Auth::id());
        $user->money = ($user->money)-($old_bill->total_price);
        $user->save();

        $req = BookingRequest::where('user_id',$user->id)->first();
        $req->status = 'สำเร็จ';
        $req->save();

        $bill = new Bill();
        $bill->room_id = $user->room_id;
        $bill->user_id = $old_bill->user_id;
        $bill->water_unit = 0;
        $bill->electric_unit = 0;
        $bill->room_price = $user->room->type->price;
        $bill->total_price = 0;
        $bill->status = 'บิลใหม่';
        $bill->activated_at = Carbon::parse($old_bill->activated_at)->addMonth(1);
        $bill->save();


        return redirect()->route('home.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showBillHistory($id,$bill)
    {
//        dd($bill);
        $room = Room::findOrFail($id);
        $user = User::findOrFail(Auth::id());
        $bills = Bill::all()->where('room_id',$room->id)->where('status','ชำระแล้ว');
        $show_bill = Bill::findOrFail($bill);
        $req = BookingRequest::all()->where('room_id',$room->id)->where('status','สำเร็จ')->first();
        $bill_this_month = Bill::where( 'activated_at', '<=', Carbon::today())->where('status','รอชำระ')->where('room_id','=',$room->id)->count();


        return view('rooms.showBillHistory',['room' => $room, 'bills' => $bills, 'show_bill'=>$show_bill, 'user'=>$user, 'req'=> $req,'bill_this_month'=>$bill_this_month]);
    }

}
