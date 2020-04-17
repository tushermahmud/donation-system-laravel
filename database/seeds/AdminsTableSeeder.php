<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class AdminsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //reset the table by truncate method
        DB::table('admins')->truncate();
        //generate 3 users
        $faker=Factory::create();
        DB::table('admins')->insert([
        	[

        	"name"		=>"sazzad mahmud",
        	"email"		=>"sazzadmahmud@gmail.com",
        	"password"	=>bcrypt('secret'),
        	],
    		[

        	"name"		=>"sazid mahmud",
        	"email"		=>"sazidmahmud@gmail.com",
        	"password"	=>bcrypt('secret123'),
       	 	],
    		[

        	"name"		=>"azaj mahmud",
        	"email"		=>"azajmahmud@gmail.com",
        	"password"	=>bcrypt('secret2fdf'),
        	]
    	]);
    }
}


