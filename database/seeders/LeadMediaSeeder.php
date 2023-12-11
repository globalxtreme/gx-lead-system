<?php

namespace Database\Seeders;

use App\Models\LeadMedia;
use Illuminate\Database\Seeder;

class LeadMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadMedia::truncate();
        $data = array(
            ['name' => 'WA Center'],
            ['name' => 'Call'],
            ['name' => 'Website'],
            ['name' => 'Email'],
            ['name' => 'WhatsApp Blast'],
            ['name' => 'Referral'],
            ['name' => 'OOH'],
            ['name' => 'Branch Badung'],
            ['name' => 'Branch Denpasar'],
            ['name' => 'Branch Malang'],
            ['name' => 'Branch Balikpapan'],
            ['name' => 'Branch Samarinda'],
            ['name' => 'Open Booth'],
            ['name' => 'Digital Platform'],
        );
        foreach ($data as $value) {
            LeadMedia::create($value);
        }
    }
}
