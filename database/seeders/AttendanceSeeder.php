<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Lecture;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $presence = new Attendance;
        $students = Student::all()->pluck('student_id')->toArray();

        $studentId = $faker->randomElement($students);
        $presence->student_id = $studentId;
        $lecture = explode(",",Student::find($studentId)->subjects);
        $size = sizeof($lecture);
        unset($lecture[$size-1]);
        $lecture = $faker->randomElement($lecture);
        $lecture = Lecture::where('class_id', $lecture)->pluck('lecture_id');
        $presence->lecture_id = $faker->randomElement($lecture);
        $presence->present = $faker->numberBetween(0,1);
        // print_r(Lecture::all()[1]->lecture_id);


        $presence->save();
    }
}
