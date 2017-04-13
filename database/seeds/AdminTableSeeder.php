<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('admin')->delete();

        $defaultUser = factory(Admin::class)->create([
        	'first_name' => 'Viral Admin',
        	'last_name' => 'Sonawala',
        	'phone' => '555555555',
        	'gender' => '1',
        	'email' => 'viral.85@gmail.com',
        	'password' => bcrypt('sonawala123'),
        	'deleted' => '1'
        ]);
    }
}
