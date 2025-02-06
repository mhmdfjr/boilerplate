<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'John Doe', 'position' => 'Professor'],
            ['name' => 'Jane Smith', 'position' => 'Researcher'],
            ['name' => 'Mark Taylor', 'position' => 'Scientist'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
