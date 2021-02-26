<?php

declare(strict_types=1);

namespace App\Console\Commands\Services\MakeDDDStructure;

use Nette\PhpGenerator\PhpNamespace;

final class MakeBusinessLogicClass extends MakeClassAbstract
{
    public function getNamespace(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string {
        return sprintf('App\Code\%s\%s\Domain\%s', $version, $domain, $classNameWithoutSuffix);
    }

    protected function getBasePath(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string {
        return sprintf('%s/Code/%s/%s/Domain/%s', app_path(), $version, $domain, $classNameWithoutSuffix);
    }

    protected function generateClass(
        PhpNamespace $namespace,
        string $classNameWithSuffix,
        string $classNameWithoutSuffix,
        string $version,
        string $domain
    ): void {
        $class = $namespace->addClass($classNameWithSuffix);
        $class
            ->setFinal(true)
            ->addMethod('__construct')
        ;

        $logicMethod = $class->addMethod('logic');
    }
}
