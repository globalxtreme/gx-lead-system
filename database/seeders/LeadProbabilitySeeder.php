<?php

namespace Database\Seeders;

use App\Models\LeadProbability;
use Illuminate\Database\Seeder;

class LeadProbabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadProbability::truncate();
        $data = array(
            ['name' => 'Pending'],
            ['name' => 'Converted'],
            ['name' => 'Cancel'],
        );
        foreach ($data as $value) {
            LeadProbability::create($value);
        }
    }
}
