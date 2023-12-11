<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BranchOfficeSeeder::class,
            LeadProbabilitySeeder::class,
            LeadTypeSeeder::class,
            LeadChannelSeeder::class,
            LeadMediaSeeder::class,
            LeadSourceSeeder::class,
            LeadStatusSeeder::class,
        ]);
    }
}
