<?php

use Illuminate\Database\Seeder;
use App\d_user;
use App\m_summary;

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

        m_summary::insert([
          's_name' => 'Kendaraan Telah Melakukan Service',
          's_code' => '1',
          'status_data' => 'true',
        ]);

        m_summary::insert([
          's_name' => 'Kendaraan Yang Harus Di Follow Up',
          's_code' => '2',
          'status_data' => 'true',
        ]);

        m_summary::insert([
          's_name' => 'Kendaraan Yang Telah Di Follow Up Dan Tidak Bersedia',
          's_code' => '3',
          'status_data' => 'true',
        ]);

        m_summary::insert([
          's_name' => 'Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Telah Melakukan Booking',
          's_code' => '4',
          'status_data' => 'true',
        ]);

        m_summary::insert([
          's_name' => 'Kendaraan Yang Telah Di Follow Up Dan Bersedia Service dan Belum Melakukan Booking',
          's_code' => '5',
          'status_data' => 'true',
        ]);
    }
}
