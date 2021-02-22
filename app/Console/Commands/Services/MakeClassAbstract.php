<?php

declare(strict_types=1);

namespace App\Console\Commands\Services;

use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

abstract class MakeClassAbstract
{
    public function make(
        string $className,
        string $version,
        string $domain,
        string $classType
    ): void {
        $classNameWithoutSuffix = $className;
        $classNameWithSuffix = $className;

        if (!str_starts_with($version, 'V')) {
            $version = sprintf('V%s', $version);
        }

        if (!str_ends_with($className, $classType)) {
            $classNameWithSuffix = sprintf('%s%s', $className, $classType);
        } else {
            $classNameWithoutSuffix = str_replace($classType, '', $classNameWithoutSuffix);
        }

        /** @TODO check if file exists and throw exception */
        $file = new PhpFile();
        $file->setStrictTypes();

        $namespace = $this->getNamespace($version, $domain, $classNameWithoutSuffix);
        $namespace = $file->addNamespace($namespace);
        $namespace = $this->generateClass(
            $namespace,
            $classNameWithSuffix,
            $classNameWithoutSuffix,
            $version,
            $domain
        );

        $basePath = $this->getBasePath($version, $domain, $classNameWithoutSuffix);
        $filePath = sprintf('%s/%s.php', $basePath, $classNameWithSuffix);
        if (!file_exists($basePath)) {
            mkdir($basePath, 0755, true);
        }
        file_put_contents($filePath, $file);
    }

    abstract public function getNamespace(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string;

    abstract protected function getBasePath(
        string $version,
        string $domain,
        string $classNameWithoutSuffix
    ): string;

    abstract protected function generateClass(
        PhpNamespace $namespace,
        string $classNameWithSuffix,
        string $classNameWithoutSuffix,
        string $version,
        string $domain
    ): PhpNamespace;
}
