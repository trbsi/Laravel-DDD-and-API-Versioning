<?php

declare(strict_types=1);

namespace App\Console\Commands\Services;

final class MakeInfrastructureStructure
{
    public function make(
        string $className,
        string $version,
        string $domain
    ): void {
        $folderPath = sprintf('%s/Code/V%s/%s/Infrastructure/%s', app_path(), $version, $domain, $className);

        if (file_exists($folderPath)) {
            return;
        }

        mkdir($folderPath, 0755, true);

        $gitKeep = sprintf('%s/.gitkeep', $folderPath);
        file_put_contents($gitKeep, '');
    }
}
