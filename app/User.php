<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function userStatements(){
        return $this->hasMany(UserStatement::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function report(){
        return $this->hasMany(Report::class);
    }

    public function bookingRequest(){
        return $this->hasMany(BookingRequest::class);
    }

    public function wifiCodes(){
        return $this->hasMany(WifiCode::class);
    }


    use Notifiable;

    protected $fillable = ['title', 'first_name', 'last_name', 'email', 'password', 'gender', 'birth_date', 'money',
                            'citizen_id', 'address', 'phone_number_1', 'phone_number_2'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->role === 'admin' ;
    }

    public function isStaff(){
        return $this->role === 'staff' ;
    }

    public function getRoomFromUser($building_name,$room_number){
        $building = DB::table('buildings')->where('name',$building_name)->first();
        $room = DB::table('rooms')->where('building_id',$building->id)->where('number',$room_number)->first();
        return $room->id;
    }

    public function haveWifi($id){
        $user = User::findOrFail($id);
        $wifi = $user->wifiCodes;
        return ($wifi->count() != 0);
    }

    public function isUpdateInfo() {
        if ($this->birth_date == null ||
            $this->citizen_id == null ||
            $this->address == null ||
            $this->phone_number_1 == null)
            return false;
        return true;
    }

}
