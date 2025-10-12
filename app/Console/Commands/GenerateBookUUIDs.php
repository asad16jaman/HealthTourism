<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Str;

class GenerateBookUUIDs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:generate-uuids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate UUIDs for books that do not have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $booksWithoutUuid = Book::whereNull('uuid')->get();

        // if ($booksWithoutUuid->isEmpty()) {
        //     $this->info('✅ All books already have UUIDs.');
        //     return;
        // }

        // foreach ($booksWithoutUuid as $book) {
        //     $book->uuid = (string) Str::uuid();
        //     $book->save();
        // }

        // $this->info('🎉 UUIDs generated for ' . $booksWithoutUuid->count() . ' books.');
        return "";
    }
}
