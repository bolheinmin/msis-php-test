<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'PHP Web Development',
                'description' => 'Learning HTML typically only requires basic computer knowledge, making it appropriate for professionals from other fields who want to learn how to develop ...',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'beginner'
            ],
            [
                'title' => 'Web Fundamental',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English.',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'beginner'
            ],
            [
                'title' => 'PHP Web Development',
                'description' => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, ',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'advanced'
            ],
            [
                'title' => 'Basic HTML',
                'description' => 'Donec blandit nibh nulla, ut cursus orci gravida in. Fusce tincidunt sollicitudin egestas. Aliquam maximus lectus eu est viverra, in tincidunt dolor efficitur. Quisque sagittis sagittis euismod. Morbi nec elementum arcu. Curabitur eu interdum magna, ut rhoncus turpis. Phasellus maximus lorem id neque blandit venenatis.',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'advanced'
            ],
            [
                'title' => 'UI/UX',
                'description' => 'Donec vel feugiat enim, at sagittis augue. Maecenas non sollicitudin nibh. Aliquam non massa ut est vehicula ultricies. In odio orci, faucibus ac luctus quis, porta quis mi. Phasellus neque metus, accumsan consectetur efficitur a, fringilla eu purus. Morbi mauris sem, pretium id sollicitudin at, egestas ut nisi. Nullam venenatis ultrices suscipit. Nullam condimentum mi diam, et tempor orci dictum sed. Curabitur dui mi, consequa',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'advanced'
            ],
            [
                'title' => 'Web Design Development',
                'description' => 'Donec blandit nibh nulla, ut cursus orci gravida in. Fusce tincidunt sollicitudin egestas. Aliquam maximus lectus eu est viverra, in tincidunt dolor efficitur. Quisque sagittis sagittis euismod. Morbi nec elementum arcu. Curabitur eu interdum magna, ut rhoncus turpis. Phasellus maximus lorem id neque blandit venenatis.',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'advanced'
            ],
            [
                'title' => 'JavaScript Development',
                'description' => 'nteger cursus arcu ac magna tincidunt, a suscipit diam tristique. Praesent nibh enim, venenatis id ultrices eu, pretium ut neque. Aenean ullamcorper mi id augue molestie, a pretium ligula laoreet. Nulla fringilla dolor nisi, sed sagittis velit mattis quis. In hac habitasse platea dictumst. Donec vulputate mattis purus in tincidunt. Nam interdum sem eget magna vestibulum gravida. Maecenas suscipit mollis pellentesque. Nunc tristiqu',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'intermediate'
            ],
            [
                'title' => 'HTML Web Development',
                'description' => 'nteger cursus arcu ac magna tincidunt, a suscipit diam tristique. Praesent nibh enim, venenatis id ultrices eu, pretium ut neque. Aenean ullamcorper mi id augue molestie, a pretium ligula laoreet. Nulla fringilla dolor nisi, sed sagittis velit mattis quis. In hac habitasse platea dictumst. Donec vulputate mattis purus in tincidunt. Nam interdum sem eget magna vestibulum gravida. Maecenas suscipit mollis pellentesque. Nunc tristiqu',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'intermediate'
            ],
            [
                'title' => 'Node Js Web Development',
                'description' => 'nteger cursus arcu ac magna tincidunt, a suscipit diam tristique. Praesent nibh enim, venenatis id ultrices eu, pretium ut neque. Aenean ullamcorper mi id augue molestie, a pretium ligula laoreet. Nulla fringilla dolor nisi, sed sagittis velit mattis quis. In hac habitasse platea dictumst. Donec vulputate mattis purus in tincidunt. Nam interdum sem eget magna vestibulum gravida. Maecenas suscipit mollis pellentesque. Nunc tristiqu',
                'instructor_id' => 2,
                'start_date' => now(),
                'end_date' => now(),
                'level' => 'intermediate'
            ],
        ]);
    }
}
