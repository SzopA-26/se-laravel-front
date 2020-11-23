<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BuildingsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoomImagesTableSeeder::class);
        $this->call(WifiCodesTableSeeder::class);
        $this->call(BillsTableSeeder::class);
        $this->call(BookingRequestsTableSeeder::class);
        $this->call(RoomImagesTableSeeder::class);
        $this->call(PackagesSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
