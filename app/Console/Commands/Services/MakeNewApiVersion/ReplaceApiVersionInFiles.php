<?php

declare(strict_types=1);

namespace App\Console\Commands\Services\MakeNewApiVersion;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

final class ReplaceApiVersionInFiles
{
    private $ignoreFiles = ['.gitkeep'];

    public function replaceVersion(string $destinationFolder, int $highestApiVersion, int $nextApiVersion): void
    {
        $directory = new RecursiveDirectoryIterator($destinationFolder);
        $iterator = new RecursiveIteratorIterator($directory);
        /** @var SplFileInfo $item */
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                continue;
            }

            if (\in_array($item->getFilename(), $this->ignoreFiles, true)) {
                continue;
            }

            $file = file_get_contents($item->getRealPath());
            $file = str_replace(
                [
                    sprintf('\V%s\\', $highestApiVersion),
                    sprintf("__('v%s", $highestApiVersion),
                ],
                [
                    sprintf('\V%s\\', $nextApiVersion),
                    sprintf("__('v%s", $nextApiVersion),
                ],
                $file
            );

            file_put_contents($item->getRealPath(), $file);
        }
    }
}
