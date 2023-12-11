<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::truncate();
        $data = array(
            ['name' => 'GlobalXtreme Bali'],
            ['name' => 'GlobalXtreme Malang'],
            ['name' => 'GlobalXtreme Malang'],
            ['name' => 'GlobalXtreme Jakarta'],
            ['name' => 'GlobalXtreme Balikpapan'],
            ['name' => 'GlobalXtreme Samarinda'],
        );
        foreach ($data as $value) {
            BranchOffice::create($value);
        }
    }
}
