<?php

namespace App\Console\Commands;

use App\Jobs\FetchMarvelCharacters;
use Illuminate\Console\Command;

class FetchCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Marvel characters from the Marvel APIs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        FetchMarvelCharacters::dispatch();
        $this->info('Fetching marvel characters');
        return 0;
    }
}
