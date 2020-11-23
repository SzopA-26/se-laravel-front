<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WifiCode extends Model
{
    use SoftDeletes;

    protected $table = 'wifi_codes';
}
