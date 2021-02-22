<?php

namespace App\Console\Commands;

use App\Console\Commands\Services\MakeBusinessLogicClass;
use App\Console\Commands\Services\MakeMiddlemanClass;
use Exception;
use Illuminate\Console\Command;

class CreateMiddlemanClassCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:middleman {version} {domain} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Middleman class for DDD';

    private MakeMiddlemanClass $makeMiddlemanClass;
    private MakeBusinessLogicClass $makeBusinessLogicClass;

    /**
     * Create a new command instance.
     */
    public function __construct(
        MakeMiddlemanClass $makeMiddlemanClass,
        MakeBusinessLogicClass $makeBusinessLogicClass
    ) {
        parent::__construct();
        $this->makeMiddlemanClass = $makeMiddlemanClass;
        $this->makeBusinessLogicClass = $makeBusinessLogicClass;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = $this->argument('version');
        $domain = $this->argument('domain');
        $name = $this->argument('name');

        try {
            $this->makeBusinessLogicClass->make($name, $version, $domain, 'BusinessLogic');
            $this->makeMiddlemanClass->make($name, $version, $domain, 'Middleman');
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 0;
        }

        $this->info('Middleman and BusinessLogic classes are generated!');

        return 0;
    }
}
