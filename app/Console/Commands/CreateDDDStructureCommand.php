<?php

namespace App\Console\Commands;

use App\Console\Commands\Services\MakeBusinessLogicClass;
use App\Console\Commands\Services\MakeControllerMethod;
use App\Console\Commands\Services\MakeInfrastructureStructure;
use App\Console\Commands\Services\MakeMiddlemanClass;
use Exception;
use Illuminate\Console\Command;

class CreateDDDStructureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ddd {version} {domain} {class-name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates base classes for DDD';

    private MakeMiddlemanClass $makeMiddlemanClass;
    private MakeBusinessLogicClass $makeBusinessLogicClass;
    private MakeInfrastructureStructure$makeInfrastructureStructure;
    private MakeControllerMethod $makeControllerMethod;

    /**
     * Create a new command instance.
     */
    public function __construct(
        MakeMiddlemanClass $makeMiddlemanClass,
        MakeBusinessLogicClass $makeBusinessLogicClass,
        MakeInfrastructureStructure $makeInfrastructureStructure,
        MakeControllerMethod $makeControllerMethod
    ) {
        parent::__construct();
        $this->makeMiddlemanClass = $makeMiddlemanClass;
        $this->makeBusinessLogicClass = $makeBusinessLogicClass;
        $this->makeInfrastructureStructure = $makeInfrastructureStructure;
        $this->makeControllerMethod = $makeControllerMethod;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $version = (int) $this->argument('version');
        $domain = $this->argument('domain');
        $className = $this->argument('class-name');

        try {
            $this->makeBusinessLogicClass->make($className, $version, $domain, 'BusinessLogic');
            $this->makeMiddlemanClass->make($className, $version, $domain, 'Middleman');
            $this->makeInfrastructureStructure->make($className, $version, $domain);
            $controllerMethod = $this->makeControllerMethod->make($className);
            $this->info('Put this to your controller');
            $this->info($controllerMethod);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 0;
        }

        $this->info('DDD classes and structure are generated!');

        return 0;
    }
}
