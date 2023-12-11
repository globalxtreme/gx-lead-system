<?php

namespace Database\Seeders;

use App\Models\LeadChannel;
use Illuminate\Database\Seeder;

class LeadChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadChannel::truncate();
        $data = array(
            ['name' => 'Official Channels'],
            ['name' => 'Walk-Ins'],
            ['name' => 'Marketing Channels'],
        );
        foreach ($data as $value) {
            LeadChannel::create($value);
        }
    }
}
