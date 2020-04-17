<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reseting the posts table by truncate method
        DB::table('orders')->truncate();
        //inserting data
        $orders=[];

        $faker=Faker\factory::create();
        for($i=0;$i<20;$i++){
        	$date=date('Y-m-d H:m:s',strtotime("2018-12-17 06:00:00 + {$i} days"));
        	$orders[]=[

        		"entrepreneur_id"		=>rand(1,3),
        		"donation_id"			=>rand(1,10),
        		"order_status"			=>'processing',
        		"grand_total"			=>rand(10000,200000),
        		"currency"				=>'BDT',
        		"profit"				=>0,
        		"created_at"			=>$date,
        		"updated_at"			=>$date,
        	];
        }
        DB::table('orders')->insert($orders);
    }
}
