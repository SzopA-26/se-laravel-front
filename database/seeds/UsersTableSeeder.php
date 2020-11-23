<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Room;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->room_id = null;
        $user->title = "นาย";
        $user->first_name = "admin";
        $user->last_name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234567890123";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->phone_number_2 = null;
        $user->role = "admin";
        $user->checkIn_at = null;
        $user->save();

        $user = new User();
        $user->room_id = null;
        $user->title = "นาย";
        $user->first_name = "guest";
        $user->last_name = "guest";
        $user->email = "guest@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->role = "user";
        $user->checkIn_at = null;
        $user->save();

        $user = new User();
        $user->room_id = 123;
        $room = Room::findOrFail(123);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "พรชัย";
        $user->last_name = "แสงสว่าง";
        $user->email = "user1@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234561";
        $user->money = 100000;
        $user->address = "33/159 ต.ท่าจีน อ.เมือง จ.สมุทรสาคร";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 215;
        $room = Room::findOrFail(215);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "ปิยวิตร";
        $user->last_name = "ทองผาสง";
        $user->email = "user2@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "0000000000000";
        $user->money = 18500;
        $user->address = "33/150 ต.ท่าจีน อ.เมือง จ.สมุทรสาคร";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = null;
        $user->title = "นาย";
        $user->first_name = "ผู้ดูแล1";
        $user->last_name = "ผู้ดูแล1";
        $user->email = "staff1@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234567899999";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->phone_number_2 = null;
        $user->role = "staff";
        $user->checkIn_at = null;
        $user->save();

        $user = new User();
        $user->room_id = null;
        $user->title = "นาง";
        $user->first_name = "ผู้ดูแล2";
        $user->last_name = "ผู้ดูแล2";
        $user->email = "staff2@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 0;
        $user->citizen_id = "1234567888888";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->phone_number_2 = null;
        $user->role = "staff";
        $user->checkIn_at = null;
        $user->save();

        $user = new User();
        $user->room_id = 1;
        $room = Room::findOrFail(1);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "อานนท์";
        $user->last_name = "สุขศิริ";
        $user->email = "user3@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234562";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 2;
        $room = Room::findOrFail(2);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "วรพัทธ์";
        $user->last_name = "อิทธิชาญ";
        $user->email = "user4@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234563";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 3;
        $room = Room::findOrFail(3);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "จิตทิวัฒน์";
        $user->last_name = "ผาสุข";
        $user->email = "user5@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234564";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 4;
        $room = Room::findOrFail(4);
        $room->available = 'no';
        $room->save();
        $user->title = "นางสาว";
        $user->first_name = "ดาวิกา";
        $user->last_name = "ประไพรพร";
        $user->email = "user6@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 0;
        $user->citizen_id = "1234561234565";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 5;
        $room = Room::findOrFail(5);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "ธมกร";
        $user->last_name = "วิทยะประดิษฐ์";
        $user->email = "user7@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234566";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 6;
        $room = Room::findOrFail(6);
        $room->available = 'no';
        $room->save();
        $user->title = "นางสาว";
        $user->first_name = "ธนาภา";
        $user->last_name = "เจริญภาสิน";
        $user->email = "user8@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 0;
        $user->citizen_id = "1234561234567";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 7;
        $room = Room::findOrFail(7);
        $room->available = 'no';
        $room->save();
        $user->title = "นางสาว";
        $user->first_name = "ภวิกา";
        $user->last_name = "แซ่ตั้ง";
        $user->email = "user9@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 0;
        $user->citizen_id = "1234561234568";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 8;
        $room = Room::findOrFail(8);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "พงศกร";
        $user->last_name = "วิเศษสมุทร";
        $user->email = "user10@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234569";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 9;
        $room = Room::findOrFail(9);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "ภูมินทร์";
        $user->last_name = "รัตนโชติ";
        $user->email = "user11@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234570";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 10;
        $room = Room::findOrFail(10);
        $room->available = 'no';
        $room->save();
        $user->title = "นาย";
        $user->first_name = "วรเมธ";
        $user->last_name = "เอี่ยมสุข";
        $user->email = "user12@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 1;
        $user->citizen_id = "1234561234571";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();

        $user = new User();
        $user->room_id = 11;
        $room = Room::findOrFail(11);
        $room->available = 'no';
        $room->save();
        $user->title = "นางสาว";
        $user->first_name = "ไอริน";
        $user->last_name = "พรเจริญศักดิ์";
        $user->email = "user13@gmail.com";
        $user->password = Hash::make('1234');
        $user->birth_date = NOW();
        $user->gender = 0;
        $user->citizen_id = "1234561234572";
        $user->address = "homeless";
        $user->phone_number_1 = "0868214563";
        $user->role = "user";
        $user->save();
    }




}
