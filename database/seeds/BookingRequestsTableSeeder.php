<?php

use Illuminate\Database\Seeder;
use App\BookingRequest;

class BookingRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request = new BookingRequest();
        $request->user_id = 3;
        $request->room_id = 123;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 4;
        $request->room_id = 215;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 7;
        $request->room_id = 1;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 8;
        $request->room_id = 2;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 9;
        $request->room_id = 3;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 10;
        $request->room_id = 4;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 11;
        $request->room_id = 5;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 12;
        $request->room_id = 6;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 13;
        $request->room_id = 7;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 14;
        $request->room_id = 8;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 15;
        $request->room_id = 9;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 16;
        $request->room_id = 10;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();

        $request = new BookingRequest();
        $request->user_id = 17;
        $request->room_id = 11;
        $request->checkIn_at = NOW();
        $request->admin_id = 1;
        $request->status = 'สำเร็จ';
        $request->save();
    }
}
