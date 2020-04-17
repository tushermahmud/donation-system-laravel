<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reseting the posts table by truncate method
        DB::table('events')->truncate();
        //inserting data
        $events=[];

        $faker=Faker\factory::create();
        for($i=0;$i<10;$i++){
        	$image='event'.'-'.rand(1,3).'.jpg';
        	$date=date('Y-m-d H:m:s',strtotime("2018-12-17 06:00:00 + {$i} days"));
        	$events[]=[

        		
        		"title"					=>$faker->sentence(),
        		"place"					=>$faker->sentence(20),
        		"slug"					=>$faker->slug(),
        		"image"					=>$image,
                "description"           =>$faker->paragraph(10),
        		"created_at"			=>$date,
        		"updated_at"			=>$date,
                "published_at"          =>rand(0,1),
                "date"                  =>$date,
                "place"                 =>$faker->address(),
                "organizer"             =>$faker->name()
        		
        	];
        }
        DB::table('events')->insert($events);

    }
}
