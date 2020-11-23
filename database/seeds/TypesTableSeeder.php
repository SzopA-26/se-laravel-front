<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new Type();
        $type->name = "Studio";
        $type->size = 25.5;
        $type->capacity = 2;
        $type->price = 5500;
        $type->save();

        $type = new Type();
        $type->name = "1 bedroom";
        $type->size = 32.5;
        $type->capacity = 3;
        $type->price = 7500;
        $type->save();

    }
}
