<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    // ห้องทั้งหมดของอาคารนี้
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
