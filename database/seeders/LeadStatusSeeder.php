<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadStatus::truncate();
        $data = array(
            ['name' => 'Consideration', 'default' => true],
            ['name' => 'Scheduled'],
            ['name' => 'Junk / Trash'],
            ['name' => 'FCB - Future Call Back'],
            ['name' => 'Qualified'],
            ['name' => 'NI - Not Interested'],
            ['name' => 'Out Coverage'],
            ['name' => 'Not Response'],
            ['name' => 'Pending'],
            ['name' => 'Cancel'],
        );
        foreach ($data as $value) {
            LeadStatus::create($value);
        }
    }
}
