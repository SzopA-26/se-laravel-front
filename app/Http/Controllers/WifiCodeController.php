<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Package;
use App\User;
use App\UserStatement;
use App\WifiCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;
use Illuminate\Support\Facades\Http;

class WifiCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $wifi_duration = $request->input('wifi');
        $room_id = $request->input('room_id');
        // $wifi = WifiCode::where('available','yes')->orderBy('created_at')->first();
        $wifi = Http::get('http://localhost:9090/api/wifi_codes/available/sorted');
        $wifi = json_decode($wifi)[0];
        //$wifi->duration = $wifi_duration;
        //$wifi->available = 'no';
        //$wifi->user_id = Auth::id();
        //$wifi->expire_at = Carbon::today()->addDays((int)$wifi_duration);
        $expire_at = Carbon::today()->addDays((int)$wifi_duration)->toDateString();
        $created_at = Carbon::now()->toDateTimeString();

        if ($wifi_duration === '1') $price = 30;
        elseif ($wifi_duration === '3') $price = 81;
        elseif ($wifi_duration === '7') $price = 190;
        elseif ($wifi_duration === '30') $price = 490;
        elseif ($wifi_duration === '90') $price = 1390;
        elseif ($wifi_duration === '365') $price = 4490;

        // update user price
        // $user = User::findOrFail(Auth::id());
        $user = json_decode(Http::get('http://localhost:9090/api/user/' . Auth::id()));
        // $user->money = ($user->money - $price);
        $money = $user->money;
        $amount = $money - $price;
        if ($amount < 0){
            return redirect()->route('rooms.show.user',['id' => $room_id]);
        }else{
            // $user->save();
            Http::put('http://localhost:9090/api/user/' . Auth::id() . '/money/' . $amount);
            // $wifi->save();
            Http::asForm()->put("http://localhost:9090/api/wifi_codes", [
                'duration' => $wifi_duration,
                'user_id' => Auth::id(),
                'available' => 2,
                'expire_at' => $expire_at,
                'id' => $wifi->id
            ]);
        }
        // create user statement
        // $statement = new UserStatement();
        // $statement->user_id = Auth::id();
        // $statement->price = $price;
        // $statement->detail = 'wifi';
        // $statement->save();
        Http::asForm()->post("http://localhost:9090/api/user_statement", [
            'user_id' => Auth::id(),
            'price' => $price,
            'detail' => 1,
            'created_at' => $created_at
            // 'created_at' => $created_at
        ]);
        //
        return redirect()->route('rooms.show.user',['id' => $room_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function userBuyWifi($id){
        // $user = User::findOrFail(Auth::id());
        $user = Http::get('http://localhost:9090/api/user/' . Auth::id());
        $user = json_decode($user);
        // $n_packages = Package::where('room_id',$id)->where('status','รอรับของ')->count();
        $n_packages = Http::get('http://localhost:9090/api/packages/room_id/' . $id . '/status/' . 1);
        $n_packages = count(json_decode($n_packages));

        $have = (new User())->haveWifi(Auth::id());
        // $bill_this_month = Bill::where( 'activated_at', '=', Carbon::today())->where('status','รอชำระ')->where('room_id','=',$user->room_id)->count();
        $today = Carbon::today();
        $bill_this_month = Http::get('http://localhost:9090/api/bill/room_id/' . $id .'/activated_at/' . $today . '/status/' . 1);
        $bill_this_month = count(json_decode($bill_this_month));

        return view('wifiCodes.buyWifi',['room' => $id, 'c' => $n_packages,'cash' => $user->money,'have' => $have,'bill_this_month'=>$bill_this_month]);
    }
}
