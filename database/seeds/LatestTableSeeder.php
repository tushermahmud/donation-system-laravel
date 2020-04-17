<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class LatestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    //reseting the posts table by truncate method
        DB::table('latests')->truncate();
        //inserting data
        $latest=[];

        $faker=Faker\factory::create();
        for($i=0;$i<10;$i++){
        	$image='cause'.'-'.rand(1,6).'.jpg';
        	$date=date('Y-m-d H:m:s',strtotime("2018-12-17 06:00:00 + {$i} days"));
        	$latest[]=[
        		"donation_id"            =>rand(1,10),
        		"title"					=>$faker->sentence(),
        		"body"					=>$faker->sentence(30),
        		"slug"					=>$faker->slug(),
        		"image"					=>$image,
        		"created_at"			=>$date,
        		"updated_at"			=>$date,
        	];
        }
        DB::table('latests')->insert($latest);

    }
}
