<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatement extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $table = 'user_statements';
}
