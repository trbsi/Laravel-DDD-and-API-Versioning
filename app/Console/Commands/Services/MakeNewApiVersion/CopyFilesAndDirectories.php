<?php

declare(strict_types=1);

namespace App\Console\Commands\Services\MakeNewApiVersion;

final class CopyFilesAndDirectories
{
    /**
     * Thank you https://www.geeksforgeeks.org/copy-the-entire-contents-of-a-directory-to-another-directory-in-php/.
     */
    public function copyOldToNewVersion(string $src, string $dst): void
    {
        // open the source directory
        $dir = opendir($src);

        // Make the destination directory if not exist
        @mkdir($dst);

        // Loop through the files in source directory
        foreach (scandir($src) as $file) {
            if (('.' !== $file) && ('..' !== $file)) {
                if (is_dir($src.'/'.$file)) {
                    // Recursively calling custom copy function
                    // for sub directory
                    $this->copyOldToNewVersion($src.'/'.$file, $dst.'/'.$file);
                } else {
                    copy($src.'/'.$file, $dst.'/'.$file);
                }
            }
        }

        closedir($dir);
    }
}
