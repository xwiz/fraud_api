<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends BaseSeeder
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
                'id' => 1,
                'first_name' => 'Harry',
                'last_name' => 'kane',
                'email' => 'harrykane@gmail.com',
                'phone_number'=> '07031111111',
                'password' => bcrypt('qwerty')
            ],
            [
                'id' => 2,
                'first_name' => 'Diego',
                'last_name' => 'Costa',
                'email' => 'diegocosta@gmail.com',
                'phone_number'=> '08030000000',
                'password' => bcrypt('asdflkj')
            ],
            [
                'id' => 3,
                'first_name' => 'Alvaro',
                'last_name' => 'Morata',
                'email' => 'alvaromorata@yahoo.com',
                'phone_number'=> '07032345678',
                'password' => bcrypt('1234567')
            ],
            
        ];
        $this->truncateAndInsert('users', $data);
    }
    
}
