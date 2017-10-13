<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypesTableSeeder extends BaseSeeder
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
                'id' => Config::get('constants.item_types.product'),
                'name' => 'Product',
            ],
            [
                'id' => Config::get('constants.item_types.service'),
                'name' => 'Service',
            ],
        ];
        $this->truncateAndInsert('item_types', $data);
    }
    
}
