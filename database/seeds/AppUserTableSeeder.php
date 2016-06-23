<?php

use Illuminate\Database\Seeder;

class AppUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appUser')->insert([
            'username'      => 'admin',
            'password'      => password_hash('admin', PASSWORD_DEFAULT),
            'regularRate'   => 75,
            'overTimeRate'  => 125.5,
            'admin'         => 1
        ]);
    }
}
