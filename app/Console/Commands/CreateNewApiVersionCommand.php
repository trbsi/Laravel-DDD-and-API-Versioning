<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateNewApiVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:new-version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This creates new api version. Copies latest API folder from "Code" folder and creates new version';

    /**
     * Create a new command instance.
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
        //copy()
        return 0;
    }

    private function readCodeDirectory()
    {
    }
}
