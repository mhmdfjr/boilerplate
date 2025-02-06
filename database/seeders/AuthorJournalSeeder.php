<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Journal;

class AuthorJournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::all();
        $journals = Journal::all();

        if ($authors->isEmpty() || $journals->isEmpty()) {
            $this->command->info('No authors or journals found. Please seed them first.');
            return;
        }

        foreach ($journals as $journal) {
            $randomAuthors = $authors->random(rand(1, 3)); // Attach 1-3 authors per journal
            $journal->authors()->attach($randomAuthors);
        }
    }
}
