<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lessons')->insert([
            [
                'title' => 'Lesson 1',
                'content' => 'Donec vel feugiat enim, at sagittis augue.',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 2',
                'content' => 'Maecenas non sollicitu',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 3',
                'content' => 'Integer facilisis imperdiet diam, non placer.',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 4',
                'content' => 'Donec vel feugiat enim, at sagittis augue.',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 5',
                'content' => 'Donec vel feugiat enim, at sagittis augue.',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 6',
                'content' => 'Maecenas non sollicitu',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 7',
                'content' => 'Donec vel feugiat enim, at sagittis augue.',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 8',
                'content' => 'Integer facilisis imperdiet diam, non placer',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 9',
                'content' => 'Maecenas non sollicitu',
                'course_id' => rand(1, 5),
            ],
            [
                'title' => 'Lesson 10',
                'content' => 'Integer facilisis imperdiet diam, non placer',
                'course_id' => rand(1, 5),
            ],
        ]);
    }
}
