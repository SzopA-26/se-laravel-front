<?php

use Illuminate\Database\Seeder;
use App\Bill;
use Carbon\Carbon;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bill = new Bill();
        $bill->room_id = 123;
        $bill->user_id = 1;
        $bill->user_paid = 3;
        $bill->water_unit= 30;
        $bill->electric_unit = 50;
        $bill->room_price = 5500;
        $bill->total_price = 6270;
        $bill->activated_at = Carbon::today()->subDay(30);
        $bill->status = 'ชำระแล้ว';
        $bill->save();

        $water_u1 = 20;
        $elec_u1 = 99;
        for($i = 12 ; $i > 1 ; $i--){
            $bill = new Bill();
            $bill->room_id = 123;
            $bill->user_id = 1;
            $bill->user_paid = 3;
            $bill->water_unit= $water_u1 - $i;
            $bill->electric_unit = $elec_u1 - $i;
            $bill->room_price = 5500;
            $bill->total_price = 5500+ (($water_u1 - $i) * 4)+ (($elec_u1 - $i) * 7);
            $bill->activated_at = Carbon::today()->subMonth($i)->addDays(1);
            $bill->status = 'ชำระแล้ว';
            $bill->save();
        }


        $water_u = 40;
        $elec_u = 100;
        for($i = 12 ; $i > 1  ; $i--){
            $bill = new Bill();
            $bill->room_id = 215;
            $bill->user_id = 1;
            $bill->user_paid = 4;
            $bill->water_unit= $water_u - $i;
            $bill->electric_unit = $elec_u - $i;
            $bill->room_price = 5500;
            $bill->total_price = 5500+ (($water_u - $i) * 4)+ (($elec_u - $i) * 7);
            $bill->activated_at = Carbon::today()->subMonth($i)->addDays(1);
            $bill->status = 'ชำระแล้ว';
            $bill->save();
        }


        $bill = new Bill();
        $bill->room_id = 215;
        $bill->user_id = 1;
        $bill->user_paid = 4;
        $bill->water_unit= 20;
        $bill->electric_unit = 134;
        $bill->room_price = 5500;
        $bill->total_price = 5500+ (20 * 4)+ (134 * 7);
        $bill->activated_at = Carbon::today();
        $bill->status = 'รอชำระ';
        $bill->save();

        $bill = new Bill();
        $bill->room_id = 123;
        $bill->user_id = 1;
//        $bill->user_paid = 3;
        $bill->water_unit= 43;
        $bill->electric_unit = 160;
        $bill->room_price = 5500;
        $bill->total_price = 5500+ (43 * 4)+ (160 * 7);
        $bill->activated_at = Carbon::today();
        $bill->status = 'บิลใหม่';
        $bill->save();


        $water_u2 = 27;
        $elec_u2 = 140;
        for($i = 12 ; $i > 1  ; $i--){
            $bill = new Bill();
            $bill->room_id = $i+3;
            $bill->user_id = 1;
            $bill->water_unit= $water_u2 - $i;
            $bill->electric_unit = $elec_u2 - ($i+3);
            $bill->room_price = 5500;
            $bill->total_price = 5500+ (($water_u2 - $i) * 4)+ (($elec_u2 - $i) * 7);
            $bill->activated_at = Carbon::today();
            $bill->status = 'บิลใหม่';
            $bill->save();
        }

        $water_u3 = 29;
        $elec_u3 = 150;
        for($i = 12 ; $i > 1  ; $i--){
            $bill = new Bill();
            $bill->room_id = $i+147;
            $bill->user_id = 1;
            $bill->water_unit= $water_u3 - $i;
            $bill->electric_unit = $elec_u3 - ($i+3);
            $bill->room_price = 5500;
            $bill->total_price = 5500+ (($water_u3 - $i) * 4)+ (($elec_u3 - $i) * 7);
            $bill->activated_at = Carbon::today();
            $bill->status = 'บิลใหม่';
            $bill->save();
        }


    }
}
