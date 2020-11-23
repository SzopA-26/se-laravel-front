<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new Package();
        $package->room_id = 1;
        $package->user_id = 5;
        $package->recipient = 'นายอานนท์ สุขจังเลย';
        $package->detail = 'กล่องใหญ่มากๆๆๆๆๆ';
        $package->image_path = 'https://www.pngitem.com/pimgs/m/485-4859452_blank-package-png-pic-package-icon-transparent-png.png';
        $package->save();

        $package = new Package();
        $package->room_id = 1;
        $package->user_id = 5;
        $package->recipient = 'นายอานนท์ สุขจังเลย';
        $package->detail = 'ยางลบ';
        $package->image_path = 'https://cdn1.productnation.co/stg/sites/6/5cd3e4326675e.jpeg';
        $package->save();

        $package = new Package();
        $package->room_id = 9;
        $package->user_id = 6;
        $package->recipient = 'นายภูมินทร์ รัตนโชติ';
        $package->detail = 'เครื่องฟอกอากาศ';
        $package->image_path = 'https://www.boonthavorn.com/media/catalog/product/cache/2/image/991x743/9df78eab33525d08d6e5fb8d27136e95/1/0/1063650_2.jpg';
        $package->save();

        $package = new Package();
        $package->room_id = 11;
        $package->user_id = 6;
        $package->recipient = 'นางสาวไอริน พรเจริญศักดิ์';
        $package->detail = 'เก้าอี้';
        $package->image_path = 'https://www.jyskthailand.com/media/catalog/product/cache/4/image/991x743/9df78eab33525d08d6e5fb8d27136e95/1/1/1111702-1.jpg';
        $package->save();
    }
}
