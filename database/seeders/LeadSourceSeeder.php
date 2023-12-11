<?php

namespace Database\Seeders;

use App\Models\LeadSource;
use Illuminate\Database\Seeder;

class LeadSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadSource::truncate();
        $data = array(
            ['name' => 'Sales'],
            ['name' => 'Customer Support'],
            ['name' => 'Tawk To'],
            ['name' => 'Lead Form'],
            ['name' => 'Google Business'],
            ['name' => 'Facebook'],
            ['name' => 'Instagram'],
            ['name' => 'Google Ads'],
            ['name' => 'TikTok'],
            ['name' => 'Meta Ads'],
        );
        foreach ($data as $value) {
            LeadSource::create($value);
        }
    }
}
