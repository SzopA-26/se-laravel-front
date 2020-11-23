<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room = 1;
        for ($i = 7 ;$i <= 13 ;$i++){
            $report = new Report();
            $report->user_id = $i ;
            $report->room_id = $room++;
            $report->title = 'ส่งเสียงดัง';
            $report->detail = 'ข้างห้องรบกวน และทำเสียงดัง';
            $report->type = 'รายงาน';
            $report->status = 'รอการยืนยัน' ;
            $report->save();
        }

        $room2 = 1;
        for ($i = 7 ;$i <= 13 ;$i++){
            $report = new Report();
            $report->user_id = $i ;
            $report->room_id = $room2++;
            $report->title = 'เครื่องปรับอากาศเสีย';
            $report->detail = 'เครื่องปรับอากาศไม่ทำงาน และมีน้ำไหลลงมา';
            $report->type = 'แจ้งซ่อม';
            $report->status = 'รอการยืนยัน' ;
            $report->save();
        }

        $room2 = 1;
        for ($i = 7 ;$i <= 13 ;$i++){
            $report = new Report();
            $report->user_id = $i ;
            $report->room_id = $room2++;
            $report->title = 'ไฟบนฝ้าไม่ติด';
            $report->detail = 'ไฟกระพริบและ บางครั้งก็ไม่ติด';
            $report->type = 'แจ้งซ่อม';
            $report->status = 'รอการยืนยัน' ;
            $report->save();
        }

        $report = new Report();
        $report->user_id = 4;
        $report->room_id = 123;
        $report->title = 'ส่งเสียงดัง';
        $report->detail = 'ข้างห้องรบกวน และทำเสียงดัง';
        $report->type = 'รายงาน';
        $report->status = 'รอการยืนยัน' ;
        $report->save();

        $report = new Report();
        $report->user_id = 7;
        $report->room_id = 123;
        $report->title = 'ได้ยินเสียงทุบผนัง';
        $report->detail = 'ได้ยินเสียงทุบผนังหรือเจาะผนังเกือบทุกเช้า';
        $report->type = 'รายงาน';
        $report->status = 'รอการยืนยัน' ;
        $report->save();


        $room3 = 1;
        for ($i = 7 ;$i <= 10 ;$i++){
            $report = new Report();
            $report->user_id = $i ;
            $report->room_id = $room3++;
            $report->title = 'ตู้เย็นชำรุด';
            $report->detail = 'ไฟที่ตู้เย็นไม่ติด';
            $report->type = 'แจ้งซ่อม';
            $report->status = 'บันทึก' ;
            $report->save();
        }
        for ($i = 7 ;$i <= 13 ;$i++){
            $report = new Report();
            $report->user_id = $i ;
            $report->room_id = $room3++;
            $report->title = 'แอบเลี้ยงสัตว์เลี่ยง';
            $report->detail = 'มีคนแอบเลี้ยงสัตว์เลี้ยงในหอพัก';
            $report->type = 'รายงาน';
            $report->status = 'บันทึก' ;
            $report->save();
        }





    }
}
