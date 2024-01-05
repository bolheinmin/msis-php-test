<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessments')->insert([
            [
                'title' => 'Assessment 1',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 2',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 3',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 4',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 5',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 6',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Assessment 7',
                'questions' => '[{"question":"Integer cursus arcu?"},{"question":"Integer cursus arcu?"}]',
                'course_id' => rand(1, 5),
            ],
        ]);
    }
}
