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
        
        DB::table('fraud_case_files')->truncate();
        DB::table('fraud_case_files')->insert($data);
    }
}
