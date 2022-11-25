<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::create([
            'name' => 'john',
            'surname' => 'smith',
            'ph_no' => (String)rand(1000000000,9999999999),
            'email' => 'john@gmail.com',
            'subjects' => '3it31,2it42',
            'image' => 'images\person.png'
        ]);
    }
}
