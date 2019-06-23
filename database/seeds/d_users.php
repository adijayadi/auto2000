<?php

use Illuminate\Database\Seeder;
use App\d_user;

class d_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        d_user::create([
          'u_name' => 'Administrator',
          'u_username' => 'admin',
          'u_email' => '1admin@gmail.com',
          'password' => bcrypt('123456'),
          'u_cmenu' => 'admin',
          'u_group' => 'admin',
          'u_user' => 'A',
          'u_code' => 'CRUD1WIB',
          'status_data' => 'true',

        ]);
    }
}
