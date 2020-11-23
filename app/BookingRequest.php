<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRequest extends Model
{
    //
//    protected $table = 'booking_requests';

    use SoftDeletes;

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function  user(){
        return $this->belongsTo(User::class);
    }




}
