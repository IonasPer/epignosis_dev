<?php

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $applications = [
        	[
	        	'user_id' => '2',
	        	'date_submitted' => '2018-10-15',
	        	'vacation_start' => '2018-10-16',
	        	'vacation_end' => '2018-10-18',
	        	'status' => 'approved',
	        	'reason' => 'My child is sick with the flu'
        	],
        	[
	        	'user_id' => '2',
	        	'date_submitted' => '2018-10-30',
	        	'vacation_start' => '2018-11-22',
	        	'vacation_end' => '2018-11-26',
	        	'status' => 'approved',
	        	'reason' => 'Going for olive oil gathering'
        	],
        	[
	        	'user_id' => '2',
	        	'date_submitted' => '2018-11-29',
	        	'vacation_start' => '2018-12-3',
	        	'vacation_end' => '2018-12-4',
	        	'status' => 'rejected',
	        	'reason' => 'Three day time off'
        	],
        	[
	        	'user_id' => '2',
	        	'date_submitted' => '2018-12-2',
	        	'vacation_start' => '2018-12-27',
	        	'vacation_end' => '2019-1-4',
	        	'status' => 'approved',
	        	'reason' => 'Family Christmas Vacation'
        	],
        ];
        foreach($applications as $application){
        	Application::create($application);        		
        }
    }
}
