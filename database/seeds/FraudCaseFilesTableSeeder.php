<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudCaseFilesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        
        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
