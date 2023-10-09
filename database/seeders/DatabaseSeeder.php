<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\StudentFinancialData;
use App\Models\StudentGrades;
use App\Models\StudentLog;
use App\Models\StudentPersonalInformation;
use App\Models\StudentRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Abdallah',
            'last_name' => 'Aziz',
            'email' => 'abdallahazizabdallahaziz@gmail.com',
            'password' => Hash::make('Admin123!'),
            'account_picture' => 'abdallahaziz.png',
        ]);
        User::create([
            'first_name' => 'Rebhi',
            'last_name' => 'Baraka',
            'email' => 'rbaraka@iugaza.edu.ps',
            'password' => Hash::make('Admin123!'),
            'account_picture' => 'admin_profile.png',
        ]);

        Lecturer::factory(25)->create()
            ->each(function ($lecturer) {
                $lecturer->lecturerCourses()
                    ->saveMany(Course::factory(rand(1, rand(1, 5)))->make());
            });

        Student::factory(100)->create()
            ->each(function ($student) {
                $student->gradesStudents()
                    ->saveMany(StudentGrades::factory(rand(0, rand(5, 35)))->make());

                $student->financialsStudents()
                    ->saveMany(StudentFinancialData::factory(rand(0, rand(5, 50)))->make());

                $student->informationsStudents()
                    ->saveMany(StudentPersonalInformation::factory(1)->make());

                $student->studentRequests()
                    ->saveMany(StudentRequest::factory(1)->make());

                $student->studentLogs()
                    ->saveMany(StudentLog::factory(rand(0, rand(5, 150)))->make());
            });
    }
}
