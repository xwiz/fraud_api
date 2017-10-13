<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(FraudCategoriesTableSeeder::class);
        $this->call(ItemTypesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(SeveritiesTableSeeder::class);
        $this->call(FraudCasesTableSeeder::class);
        $this->call(FraduEmailsTableSeeder::class);
        $this->call(FraudWebsitesTableSeeder::class);
        $this->call(FraudMobilesTableSeeder::class);
        $this->call(FraudAccountsTableSeeder::class);
        $this->call(FraudCaseFilesTableSeeder::class);

        Model::reguard();
    }
}
