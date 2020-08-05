<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //disable foreign key check for this connection before running seeders
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(DonationSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LatestTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(EventTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
