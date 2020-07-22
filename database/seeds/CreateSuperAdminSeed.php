<?php

use Illuminate\Database\Seeder;

class CreateSuperAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nid    = '11111';
        $pwd    = 'superadmin';
        $email  = 'super@admin.mail.com';

        \DB::table('biodatas')->insert([
            'nid'   => $nid,
            'nama'  => 'Super'
        ]);
        
        \DB::table('users')->insert([
            'email'     => $email,
            'bio_nid'   => $nid,
            'password'  => bcrypt($pwd),
            'level'     => 'super'
        ]);
    }
}
