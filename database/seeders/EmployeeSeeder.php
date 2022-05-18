<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        employee::factory()->count(90)->create();
    }
}
