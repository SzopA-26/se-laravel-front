<?php

namespace App\Http\Controllers;

use App\Building;
use App\Report;
use App\Room;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\Promise\all;
use Illuminate\Database\Eloquent\Builder;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'), true);
        $rooms = json_decode(Http::get('http://localhost:9090/api/rooms'), true);
        $reports = json_decode(Http::get('http://localhost:9090/api/reports/status/1/type/2'), true);
        $repairs = json_decode(Http::get('http://localhost:9090/api/reports/status/1/type/1'), true);
        $saved = json_decode(Http::get('http://localhost:9090/api/reports/status/3'), true);

        return view('reports.index',[
            'reports'=> $reports,
            'repairs'=> $repairs,
            'buildings' => $buildings,
            'rooms' => $rooms,
            'saved' => $saved
        ]);
    }

//    /**
//     * @param $building_id
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function indexBuilding($building_id) {
//
//        $buildings = json_decode(Http::get('http://localhost:9090/api/buildings'), true);
//        $building = json_decode(Http::get('http://localhost:9090/api/building/' . $building_id ), true);
//        $rooms = json_decode(Http::get('http://localhost:9090/api/rooms'), true);
//        $reports = json_decode(Http::get('http://localhost:9090/api/reports/status/1/type/2'), true);
//        $repairs = json_decode(Http::get('http://localhost:9090/api/reports/status/1/type/1'), true);
//        $saved = json_decode(Http::get('http://localhost:9090/api/reports/status/3'), true);
//
//        return view('reports.index',[
//            'reports'=> $reports,
//            'repairs'=> $repairs,
//            'buildings' => $buildings,
//            'building' => $building,
//            'rooms' => $rooms,
//            'saved' => $saved
//        ]);
//
//    }

//    public function indexBuildingFloor($building_id, $floor) {
//        $buildings = Building::all();
//        $building = Building::findOrFail($building_id);
//
//        $reports = Report::all()
//            ->where('type', '=', 'รายงาน')
//            ->where('status','=','รอการยืนยัน');
//        $repairs = Report::all()
//            ->where('type', '=', 'แจ้งซ่อม')
//            ->where('status','=','รอการยืนยัน');
//        $saved = Report::get()->where('status', 'บันทึก');
//
//        return view('reports.index',[
//            'reports'=> $reports,
//            'repairs'=> $repairs,
//            'buildings' => $buildings,
//            'building' => $building,
//            'floor' => $floor,
//            'saved' => $saved
//        ]);
//
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function userCreateReport($id){
        return view('reports.create',['room_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:100','min:3'],
            'detail' => ['required','max:500','min:3']
        ]);

        $report = new Report();
        $building_name = $request->input('building_name');
        $res = Http::get('http://localhost:9090/api/building/name/' . $building_name);
        $res = json_decode($res, true);
        $building_id = $res["id"];
        $building_floor = $request->input('building_floor');
        $room_number = $request->input('room_number');
        $res = Http::get('http://localhost:9090/api/room/building_id/' . $building_id . '/floor/' . $building_floor .'/number/' . $room_number);
        $res = json_decode($res, true);
        $room_id = $res["id"];
        $current_room_id = $request->input('room_id');
        $report->user_id = Auth::id();
        $report->room_id = $room_id;
        $report->title = $request->input('title');
        $report->detail = $request->input('detail');
        $report->type = "รายงาน";
        $report->status = "รอการยืนยัน";
        Http::asForm()->post('http://localhost:9090/api/reports', $report->toArray());

        return redirect()->route('rooms.show.user',['id' => $current_room_id]);
    }

    public function storeRepair(Request $request)
    {
//        $request->validate([
//            'title' => ['required','max:100','min:3'],
//            'detail' => ['required','max:500','min:3']
//        ]);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->room_id = $request->input('room_id');
        $report->title = $request->input('title');
        $report->detail = $request->input('detail');
        $report->type = "แจ้งซ่อม";
        $report->status = "รอการยืนยัน";
        Http::asForm()->post('http://localhost:9090/api/reports', $report->toArray());

        return redirect()->route('rooms.show.user',['id' => $report->room_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('reports.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Http::get('http://localhost:9090/api/report/' . $id);
        $room = Http::get('http://localhost:9090/api/room/' . $report['id']);

        return view('reports.edit',['report' => $report, 'room' => $room]);
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        $report = Report::findOrFail($id);
//        $report->status = 'อนุมัติ';
//        $report->save();
//
//        return redirect()->route('reports.index');
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Http::delete('http://localhost:9090/api/report/' . $id);
        return redirect()->route('reports.index');
    }


//    public function seachRoom(Request $request){
//        $floor = (int)$request->input('floor');
//        $building = (int)$request->input('building');
//        $number = (int)$request->input('number');
//
//
//        if ($request->has('building')) {
//            $repairs = DB::table('reports')
//                ->leftJoin('rooms', 'reports.room_id', '=', 'rooms.id')
//                ->select('*')
//                ->where('building_id', '=', $building)
//                ->where('floor', '=', $floor)
//                ->where('number', '=', $number)
//                ->where('type', '=', 'แจ้งซ่อม')
//                ->where('status', '=', 'รอการยืนยัน')
//                ->get();
//
//            $reports = DB::table('reports')
//                ->join('rooms', 'reports.room_id', '=', 'rooms.id')
//                ->select('*')
//                ->where('building_id', '=', $building)
//                ->where('floor', '=', $floor)
//                ->where('number', '=', $number)
//                ->where('type', '=', 'รายงาน')
//                ->where('status', '=', 'รอการยืนยัน')
//                ->get();
//        }
//
//        return view('reports.index',['reports'=> $reports,'repairs'=> $repairs]);
//    }

    public function save($id) {
//        $report = Report::findOrFail($id);
//
//        $report->status = 'บันทึก';
//        $report->save();

        Http::asForm()->put("http://localhost:9090/api/reports", [
            'status' => 'บันทึก',
            'id' => $id
        ]);

        return redirect()->route('reports.index');
    }

}
