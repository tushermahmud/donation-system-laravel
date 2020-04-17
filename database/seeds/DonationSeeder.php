<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reseting the posts table by truncate method
        DB::table('donations')->truncate();
        //inserting data
        $donations=[];

        $faker=Faker\factory::create();
        for($i=0;$i<10;$i++){
        	$image='cause'.'-'.rand(1,6).'.jpg';
        	$date=date('Y-m-d H:m:s',strtotime("2018-12-17 06:00:00 + {$i} days"));
        	$donations[]=[

        		"entrepreneur_id"		=>rand(1,3),
        		"title"					=>$faker->sentence(),
        		"body"					=>$faker->sentence(30),
        		"slug"					=>$faker->slug(),
        		"image"					=>$image,
                "description"           =>$faker->paragraph(10),
                "additional"            =>$faker->paragraph(10),
                "goals"                 =>$faker->paragraph(10),
        		"created_at"			=>$date,
        		"updated_at"			=>$date,
        		"donation_needed"		=>rand(10000,50000),
        		"total_collection"		=>rand(10000,30000),
                "published_at"  		=>rand(0,1)
        	];
        }
        DB::table('donations')->insert($donations);

    }
}
