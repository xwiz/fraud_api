<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeverityTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => Config::get('constants.severity.low'),
                'rating' => 'Low',
            ],
            [
                'id' => Config::get('constants.severity.average'),
                'rating' => 'Average',
            ],
            [
                'id' => Config::get('constants.severity.high'),
                'rating' => 'High',
            ],
        ];
        $this->truncateAndInsert('severities', $data);
    }
}
