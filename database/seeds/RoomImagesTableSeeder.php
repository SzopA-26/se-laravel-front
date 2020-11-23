<?php

use App\Room;
use Illuminate\Database\Seeder;
use App\RoomImage;

class RoomImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();
        foreach ($rooms as $room) {
            for ($i=1;$i<=8;$i++) {
                if ($room->type->name == 'Studio') {
                    $roomImage = new RoomImage();
                    $roomImage->room_id = $room->id;
                    $roomImage->image_path = "/images/studio/room" . $i . ".jpg";
                    $roomImage->save();
                } else {
                    $roomImage = new RoomImage();
                    $roomImage->room_id = $room->id;
                    $roomImage->image_path = "/images/bedroom/room" . $i . ".jpg";
                    $roomImage->save();
                }
            }
        }
    }



}
