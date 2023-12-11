<?php

namespace Database\Seeders;

use App\Models\LeadType;
use Illuminate\Database\Seeder;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadType::truncate();
        $data = array(
            ['name' => 'Inbound'],
            ['name' => 'Outbound'],
        );
        foreach ($data as $value) {
            LeadType::create($value);
        }
    }
}
