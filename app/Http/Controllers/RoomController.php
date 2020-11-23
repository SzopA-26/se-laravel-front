<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BookingRequest;
use App\Building;
use App\Package;
use App\User;
use Carbon\Carbon;
use App\Type;
use App\WifiCode;
use Illuminate\Http\Request;
use App\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\MockObject\Api;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $u = Auth::id();
        $user = User::findOrFail($u);

        if(!auth()->user()->isUpdateInfo()) {
            return redirect()->route('user.edit', ['user' => $user->id])->with('alert', 'กรุณาแก้ไขข้อมูลให้ครบถ้วน');
        }

        $types = json_decode(Http::get('http://localhost:9090/api/types'), true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $id),true);
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);
        $rooms = json_decode(Http::get('http://localhost:9090/api/room/type_id/' . $id), true);


        return view('rooms.index', [
                'types' => $types,
                'rooms' => $rooms,
                'buildings' => $buildings,
                'selected_type' => $type,

        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @param int $building_id
     * @return Response
     */
    public function indexBuilding($id, $building_id)
    {
        $types = json_decode(Http::get('http://localhost:9090/api/types'),true);

        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $id),true);

        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);

        $rooms = json_decode(Http::get('http://localhost:9090//api/room/type_id/'.$type["id"].'/building_id/'.$building_id),true);
        $building = json_decode(Http::get('http://localhost:9090/api/building/'.$building_id),true);

        return view('rooms.index', [
            'types' => $types,
            'rooms' => $rooms,
            'buildings' => $buildings,
            'building' => $building,
            'selected_type' => $type,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @param $building_id
     * @param $floor
     * @return Response
     */
    public function indexBuildingFloor($id, $building_id, $floor)
    {
        $types = Http::get('http://localhost:9090/api/types');
        $type = Http::get('http://localhost:9090/api/type/' . $id);
        $buildings = Http::get('http://localhost:9090/api/buildings');
        $rooms = Http::get('http://localhost:9090//api/room/type_id/'.$type["id"].'/building_id/'.$building_id.'/floor'.$floor);
        $building = Http::get('http://localhost:9090/api/building/'.$building_id);

        return view('rooms.index', [
            'types' => $types,
            'rooms' => $rooms,
            'buildings' => $buildings,
            'building' => $building,
            'selected_type' => $type,
            'selected_floor' => $floor
        ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
//        $room = Room::findOrFail($id);
//        $room_images = DB::table('room_images')->select('*')->where('room_id',$room->id)->get();
//        dd($room_images);

        $response = Http::get('http://localhost:9090/api/room/' . $id);
        $room = $response;
        $response = Http::get('http://localhost:9090/api/type/' . $room["type_id"]);
        $type = $response;
        $response = Http::get('http://localhost:9090/api/building/' . $room["building_id"]);
        $building = $response;
        $response = Http::get('http://localhost:9090/api/room_image/room_id/' . $id);
        $room_images = $response;

        return view('rooms.show',[
            'room' => $room,
            'type' => $type,
            'room_images' => $room_images,
            'building' => $building
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showStaff($id)
    {
//        $room = Room::findOrFail($id);
        $response = Http::get('http://localhost:9090/api/room/' . $id);
        $room = $response;
        $response = Http::get('http://localhost:9090/api/type/' . $room["type_id"]);
        $type = $response;
        $response = Http::get('http://localhost:9090/api/building/' . $room["building_id"]);
        $building = $response;
        $response = Http::get('http://localhost:9090/api/user/' . $room["building_id"]);
        $user = $response;


        return view('rooms.showStaff',[
            'room' => $room,
            'building'=> $building,
            'type' => $type]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function userRoom($id)
    {
        $room = Room::findOrFail($id);
        $today =Carbon::today();
        $bill = Bill::where( 'activated_at', '<=', $today)->where('status','รอชำระ')->where('room_id','=',$room->id)->count();


        $request = BookingRequest::get()->where('room_id', $id)->where('deleted_at', null)->first();
        if(!$request) {
            return redirect()->route('home.index');
        }

        $n_packages = Package::where('room_id',$id)->where('status','รอรับของ')->count();
        $wifi_code = WifiCode::where('user_id',Auth::id())->first();

        //update wifi
        if ($wifi_code != null) {
            $expiredate = Carbon::create($wifi_code->expire_at);
            $today = Carbon::today();
            if ($today->gte($expiredate)) {
                $wifi_code->delete();
            }
        }
        $wifi_code = WifiCode::where('user_id',Auth::id())->first();

        return view('rooms.myRoom',['room' => $room, 'c' => $n_packages,'wifi_code' => $wifi_code, 'request' => $request,'bill'=>$bill]);
    }

    public function roomPackages($id){
        $packages = Package::where('room_id',$id)->where('status','รอรับของ')->get();
        $his_package = Package::where('room_id',$id)->where('status','ได้รับแล้ว')->orderBy('updated_at','desc')->get();
        return view('rooms.showPackages',['packages' => $packages,'his' => $his_package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function test()
    {

    }
}
