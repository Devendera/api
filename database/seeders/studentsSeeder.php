<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Carbon;

class studentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $dateTime = Carbon\Carbon::now();
        for ($i=0; $i < 530; $i++) {
            $counter = $i + 1;
            $data[] = array('name' => 'student '.$counter , 'branch_id' => 1,'class' => 'I',
                'section' => 'A','join_date' => $dateTime);
        }

        Student::insert($data);
    }
}
