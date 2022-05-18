<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        company::factory()->count(30)->create();
    }
}
