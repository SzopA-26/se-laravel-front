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
use Illuminate\Support\Facades\Http;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = json_decode(Http::get('http://localhost:9090/api/booking_requests'),true);
        $types = json_decode(Http::get('http://localhost:9090/api/types'),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . 1),true);
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);


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
        $requests = json_decode(Http::get('http://localhost:9090/api/booking_requests'),true);
        $types = json_decode(Http::get('http://localhost:9090/api/types'),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $type_id),true);
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);

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
        $requests = json_decode(Http::get('http://localhost:9090/api/booking_requests'),true);
        $types = json_decode(Http::get('http://localhost:9090/api/types'),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $type_id),true);
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);
        $building = json_decode(Http::get('http://localhost:9090/api/building/' . $building_id),true);

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
        $requests = json_decode(Http::get('http://localhost:9090/api/booking_requests'),true);
        $types = json_decode(Http::get('http://localhost:9090/api/types'),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $type_id),true);
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'),true);
        $building = json_decode(Http::get('http://localhost:9090/api/building/' . $building_id),true);

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
        $room = json_decode(Http::get('http://localhost:9090/api/room/'.$room),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $room["type_id"]),true);
        $building = json_decode(Http::get('http://localhost:9090/api/building/' . $room["building_id"]),true);


        return view('requests.create', [
            'building'=> $building,
            'room' => $room,
            'type'=> $type
            ]);

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



        $response_req = Http::asForm()->post('http://localhost:9090/api/booking_requests',[
            'user_id' => $request->input('user_id'),
            'room_id' => $request->input('room_id'),
            'checkIn_at' => $request->input('checkin_date'),
            'admin_id' => Auth::id(),
            'status' => 'รอการยืนยัน',
            'created_at' => Carbon::now()->toDateString()


        ]);
        $room = json_decode(Http::get('http://localhost:9090/api/room/'.$request->input('room_id')),true);
        $response_room = Http::asForm()->put('http://localhost:9090/api/room',[
            'available' => 'no',
            'id' => $request->input('room_id'),
        ]);

        $user = json_decode(Http::get('http://localhost:9090/api/user/'.$request->input('user_id')),true);
        $response_user = Http::asForm()->put('http://localhost:9090/api/users',[
            'room_id' => $request->input('room_id'),
            'checkIn_at' => $request->input('checkin_date'),
            'id' => $request->input('user_id'),
            'title' => $user['title'],
            'first_name' => $user['first_name'],
            'last_name' => $user["last_name"],
            'email' => $user["email"],
            'birth_date' => Carbon::parse($user["birth_date"])->toDateString(),
            'citizen_id' => $user["citizen_id"],
            'address' => $user["address"],
            'phone_number_1' => $user["phone_number_1"],
            'phone_number_2' => $user["phone_number_2"],
            'money' => $user["money"],
            'invited' => $user["invited"],
            'img' => $user["img"]
        ]);

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
        $request = json_decode(Http::get('http://localhost:9090/api/booking_request/'.$id),true);
        $user = json_decode(Http::get('http://localhost:9090/api/users/room_id/' . $request["id"]),true);
        $room = json_decode(Http::get('http://localhost:9090/api/room/' . $request["room_id"]),true);
        $type = json_decode(Http::get('http://localhost:9090/api/type/' . $room["type_id"]),true);

        $building = json_decode(Http::get('http://localhost:9090/api/building/' . $room["building_id"]),true);



        return view('requests.show', [
            'request' => $request,
            'user'=> $user,
            'building'=> $building,
            'room' => $room,
            'type'=> $type]);

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
