<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BookingRequest;
use App\Building;
use App\Room;
use App\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = BookingRequest::all();
        $types = Type::all();
        $type = Type::find(1);
        $buildings = Building::all();
        return view('requests.index', [
            'types' => $types,
            'buildings' => $buildings,
            'selected_type' => $type,
            'requests' => $requests
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type_id
     * @return \Illuminate\Http\Response
     */
    public function indexType($type_id)
    {
        $requests = BookingRequest::all();
        $types = Type::all();
        $type = Type::find($type_id);
        $buildings = Building::all();
        return view('requests.index', [
            'types' => $types,
            'buildings' => $buildings,
            'selected_type' => $type,
            'requests' => $requests
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type_id
     * @param $building_id
     * @return \Illuminate\Http\Response
     */
    public function indexBuilding($type_id, $building_id)
    {
        $requests = BookingRequest::all();
        $types = Type::all();
        $type = Type::find($type_id);
        $buildings = Building::all();
        $building = Building::findOrFail($building_id);
        return view('requests.index', [
            'types' => $types,
            'buildings' => $buildings,
            'building' => $building,
            'selected_type' => $type,
            'requests' => $requests
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type_id
     * @param $building_id
     * @param $floor
     * @return \Illuminate\Http\Response
     */
    public function indexBuildingFloor($type_id, $building_id, $floor)
    {
        $requests = BookingRequest::all();
        $types = Type::all();
        $type = Type::find($type_id);
        $buildings = Building::all();
        $building = Building::findOrFail($building_id);
        return view('requests.index', [
            'types' => $types,
            'buildings' => $buildings,
            'building' => $building,
            'selected_type' => $type,
            'requests' => $requests,
            'selected_floor' => $floor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $room
     * @return \Illuminate\Http\Response
     */
    public function create($room)
    {
        $room = Room::findOrFail($room);
        return view('requests.create', [ 'room'  => $room ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'checkin_date' => ['required', 'date', 'after:today']
        ]);

        $req = new BookingRequest;
        $req->user_id = $request->input('user_id');
        $req->room_id = $request->input('room_id');
        $req->checkIn_at = $request->input('checkin_date');

        $room = Room::findOrFail($request->input('room_id'));
        $room->available = 'no';
        $room->save();

        $user = User::findOrFail($request->input('user_id'));
        $user->room_id = $req->room_id;
        $user->checkIn_at = $req->checkIn_at;
        $user->save();

        $req->save();
        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = BookingRequest::findOrFail($id);
        return view('requests.show', ['request' => $request]);

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
//        $user_now = Auth::id();
//        $request = BookingRequest::findOrFail($id);
//        $room = Room::findOrFail($request->room_id);
//        $request->admin_id = $user_now;
//        $request->status = 'ยืนยันแล้ว';
//        $request->save();
//
//
//        $user = User::findOrFail($request->user_id);
//        $user->room_id = $request->room_id;
//        $user->checkIn_at = $request->checkIn_at;
//        $user->save();
//
//
//
//        return redirect()->route('requests.index');



    }

    public function updateConfirm($id) {
        $req = BookingRequest::findOrFail($id);
        $req->status = 'รอการชำระเงิน';
        $req->admin_id = Auth::user()->id;
        $req->save();

        $bill = new Bill();
        $bill->room_id = $req->room_id;
        $bill->user_id = Auth::id();
        $bill->water_unit = 0;
        $bill->electric_unit = 0;
        $bill->room_price = $req->room->type->price;
        $bill->total_price = ($req->room->type->price) * 2;
        $bill->status = 'รอชำระ';
        $bill->activated_at = $req->user->checkIn_at;

        $bill->save();

        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = BookingRequest::findOrFail($id);

        $user = User::findOrFail($req->user_id);
        $user->room_id = null;
        $user->checkIn_at = null;
        $user->save();

        $room = Room::findOrFail($req->room_id);
        $room->available = 'yes';
        $room->save();

        $req->delete();
        return redirect()->route('requests.index');
    }
}
