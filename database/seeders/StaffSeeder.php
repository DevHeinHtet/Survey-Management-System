<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::factory(10)
            ->hasSurveys(20)
            ->create();

        Staff::factory(5)
            ->hasSurveys(10)
            ->create();

        Staff::factory(3)
            ->create();
    }
}
