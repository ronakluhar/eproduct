<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        $this->command->info('User table seeded!');
        $this->call(AdminTableSeeder::class);
        $this->command->info('Admin table seeded!');
        $this->call(PropertyActionTypeSeeder::class);
        $this->command->info('Property action type table seeded!');
        $this->call(PropertyFieldTypeSeeder::class);
        $this->command->info('Property field type table seeded!');
        $this->call(LanguageTableSeeder::class);
        $this->command->info('Language table seeded!');
    
        Model::reguard();
    }
}
