<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //พัสดุของห้องไหน
    public function room(){
        return $this->belongsTo(Room::class);
    }

    //พัสดุนี้ใครเป็นคนรับเรื่อง
    public function user(){
        return $this->belongsTo(User::class);
    }


}
