<?php

use Illuminate\Database\Seeder;
use App\WifiCode;
use Carbon\Carbon;

class WifiCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3FC";
        $wifi1->save();

        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3FE";
        $wifi1->save();

        $wifi7 = new WifiCode();
        $wifi7->code = "kures1_DFGFDFF3FF";
        $wifi7->save();

        $wifi7 = new WifiCode();
        $wifi7->code = "kures1_DFGFDFF3FG";
//        $wifi7->expire_at = Carbon::today()->addDays(7);
        $wifi7->save();

        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3H";
        $wifi1->save();

        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3FI";
        $wifi1->save();

        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3FJ";
        $wifi1->save();

        $wifi1 = new WifiCode();
        $wifi1->code = "kures1_DFGFDFF3FK";
        $wifi1->save();
    }
}
