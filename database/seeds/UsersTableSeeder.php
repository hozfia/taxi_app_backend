<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$bMEyVZ2wrq7a4AQZ17ZIV.gW82jvnmejK9yLADvrh0cWKG.nr/DPG',
                'remember_token' => null,
                'created_at'     => '2019-09-23 09:25:21',
                'updated_at'     => '2019-09-23 09:25:21',
            ],
        ];

        User::insert($users);
    }
}
