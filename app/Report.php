<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    //report นี้เป็นของ user คนไหน
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function searchReport(){
        $reports = Report::all()
                    ->where('type', '=', 'รายงาน')
                    ->where('status','=','รอการยืนยัน');
        return $reports;
    }

    public function searchRepair(){
        $repairs = DB::table('reports')->select('*')
                    ->where('type', '=', 'แจ้งซ่อม')
                    ->where('status','=','รอการยืนยัน');
        return $repairs;
    }

    public function searchFilterRepair(){
        $repairs = DB::table('reports')
            ->join('rooms', 'reports.room_id', '=', 'rooms.id')
            ->join('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->select('*')
            ->where('type', '=', 'แจ้งซ่อม')
            ->where('status','=','รอการยืนยัน')
            ->get();
        return $repairs;
    }

    public function searchFliterReport($building){
        $reports = Report::all()
            ->where('type', '=', 'รายงาน')
            ->where('status','=','รอการยืนยัน')
            ->where('name', '=', $building);
        return $reports;
    }





}
