<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@example.com',
                'role'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@example.com',
                'role'=>'0',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Rider',
                'email'=>'rider@example.com',
                 'role'=>'3',
                'password'=> bcrypt('123456'),
             ],
             [
                'name'=>'Teller',
                'email'=>'teller@example.com',
                 'role'=>'2',
                'password'=> bcrypt('123456'),
             ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
