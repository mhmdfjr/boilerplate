<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Journal;
use App\Models\User;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        Journal::insert([
            [
                'user_id' => $user->id,
                'title' => 'Introduction to Laravel',
                'content' => 'Laravel is a powerful PHP framework for building web applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'title' => 'Building REST APIs',
                'content' => 'REST APIs are essential for modern web applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'title' => 'Advanced Eloquent Queries',
                'content' => 'Eloquent provides powerful query-building capabilities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
