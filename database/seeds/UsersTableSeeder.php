<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //reset the table by truncate method
        DB::table('users')->truncate();
        //generate 3 users
        $faker=Factory::create();
        DB::table('users')->insert([
        	[

        	"name"		        =>"sazzad mahmud",
            "slug"              =>"sazzad-mahmud",
        	"email"		        =>"sazzadmahmud01795355849@gmail.com",
        	"password"	        =>bcrypt('secret'),
            "verify_token"      =>null,
            "status"            =>1
        	],
    		[

        	"name"		      =>"sazid mahmud",
            "slug"            =>"sazid-mahmud",
        	"email"		      =>"sazzad.mahmud1417027@gmail.com",
        	"password"	      =>bcrypt('secret123'),
            "verify_token"    =>null,
            "status"          =>1
       	 	],
    		[

        	"name"		       =>"azaj mahmud",
            "slug"             =>"azaj-mahmud",
        	"email"		       =>"sazzadtusher1417027@gmail.com",
        	"password"	       =>bcrypt('secret2fdf'),
            "verify_token"     =>null,
            "status"           =>1
        	]
    	]);
    }
}

