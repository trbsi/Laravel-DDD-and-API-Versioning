<?php

declare(strict_types=1);

namespace App\Console\Commands\Services;

use Nette\PhpGenerator\PhpNamespace;

final class MakeMiddlemanClass extends MakeClassAbstract
{
    private MakeBusinessLogicClass $makeBusinessLogicClass;

    public function __construct(MakeBusinessLogicClass $makeBusinessLogicClass)
    {
        $this->makeBusinessLogicClass = $makeBusinessLogicClass;
    }

    public function getNamespace(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string {
        return sprintf('App\Code\%s\%s\Application\Middlemen', $version, $domain);
    }

    protected function getBasePath(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string {
        return sprintf('%s/Code/%s/%s/Application/Middlemen', app_path(), $version, $domain);
    }

    protected function generateClass(
        PhpNamespace $namespace,
        string $classNameWithSuffix,
        string $classNameWithoutSuffix,
        string $version,
        string $domain
    ): void {
        $propertyClass = sprintf('%sBusinessLogic', $classNameWithoutSuffix);
        $propertyName = lcfirst($propertyClass);

        //Add "Use"
        $use = $this->makeBusinessLogicClass->getNamespace($version, $domain, $classNameWithoutSuffix);
        $namespace
            ->addUse(sprintf('%s\%s', $use, $propertyClass))
        ;

        //Create Middleman class and properties
        $class = $namespace->addClass($classNameWithSuffix);
        $class
            ->setFinal(true)
        ;

        $class
            ->addProperty($propertyName)
            ->setType($propertyClass)
            ->setPrivate()
        ;

        //add construct to class
        $constructBody = sprintf('$this->%s = $%s;', $propertyName, $propertyName);
        $constructMethod = $class->addMethod('__construct')
            ->setBody($constructBody)
        ;
        $constructMethod
            ->addParameter($propertyName)
            ->setType($propertyClass)
        ;

        $mediateToBusinessLogicMethod = $class->addMethod('mediate')
            ->addBody(sprintf('//return $this->%s->logic(..some params);', $propertyName))
        ;

        $mediateToBusinessLogicMethod
            ->addParameter('someParam')
            ->setType('int')
        ;
    }
}
