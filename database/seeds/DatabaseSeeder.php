<?php

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        $this->call('TimezonesSeeder');
        $this->call('CurrenciesSeeder');
        $this->call('CountriesSeeder');
        $this->call('StatesSeeder');
        $this->call('RolesSeeder');
        $this->call('UsersSeeder');
        $this->call('ModulesSeeder');
        $this->call('PermissionsSeeder');
        $this->call('AddressTypesSeeder');

        $this->command->info('====Lux.===// SEEDING COMPLETE ! //=======');

        Model::reguard();
    }
}
