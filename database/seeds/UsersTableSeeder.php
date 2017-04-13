<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $defaultUser = factory(User::class)->create([
        	'first_name' => 'Viral',
        	'last_name' => 'Sonawala',
        	'phone' => '8888888888',
            'username' => 'viral_sonawala',
        	'gender' => '1',
        	'email' => 'viral85@gmail.com',
        	'password' => bcrypt('sonawala123'),
        	'deleted' => '1'
        ]);
    }
}
