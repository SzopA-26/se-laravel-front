<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
