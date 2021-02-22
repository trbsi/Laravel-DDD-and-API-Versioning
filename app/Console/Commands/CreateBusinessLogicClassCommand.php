<?php

namespace App\Console\Commands;

use App\Console\Commands\Services\MakeBusinessLogicClass;
use Illuminate\Console\Command;

class CreateBusinessLogicClassCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:business-logic {version} {domain} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates BusinessLogic class for DDD';

    protected $help = "version=1,2,3...\ndomain=User\nname=class name such as CreateUser";

    private MakeBusinessLogicClass $makeBusinessLogicClass;

    /**
     * Create a new command instance.
     */
    public function __construct(MakeBusinessLogicClass $makeBusinessLogicClass)
    {
        parent::__construct();
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

        $this->makeBusinessLogicClass->make($name, $version, $domain, 'BusinessLogic');
        $this->info('BusinessLogic class generated!');

        return 0;
    }
}
