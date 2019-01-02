<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
        	[
	        	'first_name' => 'admin',
	        	'last_name' => 'admin',
	        	'email' => 'admin@epignosis.com',
	        	'password' => Hash::make('password'),
	        	'remember_token' => str_random(10),
	        	'user_type' => 'admin'
        	],
        	[
	        	'first_name' => 'George',
	        	'last_name' => 'Michael',
	        	'email' => 'geom@gmail.com',
	        	'password' => Hash::make('password'),
	        	'remember_token' => str_random(10),
	        	'user_type' => 'employee'
        	]
        ];
        foreach($users as $user){
        	User::create($user);        		
        }

        
    }
}
