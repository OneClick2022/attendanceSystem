<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'           => 'mahek kantharia',
            'email'          => 'mahek@gmail.com',
            'password'       => Hash::make('Mahek@0902'),
            'user_type'      => 'faculty',
            'remember_token' => str_random(10),
        ]);
    }
}
