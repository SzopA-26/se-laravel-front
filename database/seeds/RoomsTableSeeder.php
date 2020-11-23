<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=9;$i++) {
            if ($i>=7) {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 1;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 1;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            } else {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 1;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 1;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            }
        }

        for($i=1;$i<=9;$i++) {
            if ($i>=7) {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 2;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 2;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            } else {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 2;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 2;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            }
        }

        for($i=1;$i<=9;$i++) {
            if ($i>=7) {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 3;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 3;
                        $room->floor = $i;
                        $room->type_id = 2;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            } else {
                for($j=1;$j<=12;$j++) {
                    if($j>=10) {
                        $room = new Room();
                        $room->building_id = 3;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . $j;
                    } else {
                        $room = new Room();
                        $room->building_id = 3;
                        $room->floor = $i;
                        $room->type_id = 1;
                        $room->number = $i . '0' . $j;
                    }$room->save();
                }
            }
        }
    }

}
