<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        //reseting the posts table by truncate method
        DB::table('comments')->truncate();
        //inserting data
        $comments=[];

        $faker=Faker\factory::create();
        for($i=0;$i<20;$i++){
        	$comments[]=[
        		"entrepreneur_id"		=>rand(1,3),
        		"donation_id"			=>rand(1,10),
        		"body"					=>$faker->sentence(30),
        		"created_at"			=>$faker->date(),
        		"updated_at"			=>$faker->date(),
        	];
        }
        DB::table('comments')->insert($comments);

   
    }
}
