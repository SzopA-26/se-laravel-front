<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }

    public function bookingRequest(){
        return $this->hasOne(BookingRequest::class);
    }

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function roomImages(){
        return $this->hasMany(RoomImage::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function isAdmin(){
        return $this->role === 'admin' ;
    }

    public function isStaff(){
        return $this->role === 'staff' ;
    }

    public function allRoom(){

        $rooms = DB::table('rooms')->select('*')
            ->where('available','=',"no")
            ->orderBy('building_id','asc')
            ->orderBy('floor','asc')
            ->orderBy('number','asc')
            ->get();
        return $rooms;

    }

}
