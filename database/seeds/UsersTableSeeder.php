<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@moka.com',
                'name' => 'Admin',
                'password' => 'adminadmin',
            ],
            [
                'email' => 'user@moka.com',
                'name' => 'Test User',
                'password' => 'secretsecret',
            ],
            [
                'email' => 'dummy.user@moka.com',
                'name' => 'Dummy User',
                'password' => 'dummydummy',
            ],
        ];

        foreach ($users as $user) {
            \App\User::create([
                'email' => $user['email'],
                'name' => $user['name'],
                'password' => bcrypt($user['password']),
            ]);
        }
    }
}
