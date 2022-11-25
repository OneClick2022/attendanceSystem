<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Subjects;
use App\Models\Lecture;
use Illuminate\Support\Str;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $lecture = new Lecture;
        $subjects = Subjects::all()->pluck('class_id')->toArray();
            $uuid = Str::uuid()->toString();
            $lecture->lecture_id = $uuid;
            $lecture->class_id = $faker->randomElement($subjects);
            $lecture->lecture_date = $faker->dateTimeBetween('2022-01-01','2022-12-31');
            $lecture->save();
    }
}
