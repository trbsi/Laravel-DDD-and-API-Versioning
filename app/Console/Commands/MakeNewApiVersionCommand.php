<?php

namespace App\Console\Commands;

use App\Console\Commands\Services\MakeNewApiVersion\CopyFilesAndDirectories;
use App\Console\Commands\Services\MakeNewApiVersion\ReplaceApiVersionInFiles;
use DirectoryIterator;
use Illuminate\Console\Command;

class MakeNewApiVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:new-api-version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This creates new api version. Copies latest API folder from "Code" folder and creates new version';

    private CopyFilesAndDirectories $copyFilesAndDirectories;
    private string $apiDirectoryPath;
    private int $highestApiVersion;
    private int $nextApiVersion;
    private string $highestApiVersionDirectory;
    private string $nextApiVersionDirectory;
    private ReplaceApiVersionInFiles $replaceApiVersionInFiles;

    /**
     * Create a new command instance.
     */
    public function __construct(
        CopyFilesAndDirectories $copyFilesAndDirectories,
        ReplaceApiVersionInFiles $replaceApiVersionInFiles
    ) {
        parent::__construct();
        $this->copyFilesAndDirectories = $copyFilesAndDirectories;
        $this->replaceApiVersionInFiles = $replaceApiVersionInFiles;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('STARTED...');
        $this->apiDirectoryPath = app_path('Code');

        $this
            ->getHighestApiVersion()
            ->copyCodeFilesAndDirectories()
            ->copyLanguageFilesAndDirectories()
            ->replaceApiVersionInFiles()
        ;

        //@TODO copy tests files
        //@TODO copy routes
        $this->info('DONE!');

        return 0;
    }

    private function getHighestApiVersion(): self
    {
        $directory = new DirectoryIterator($this->apiDirectoryPath);
        $highestApiVersion = 1;
        foreach ($directory as $file) {
            if ($file->isDot() || !$file->isDir()) {
                continue;
            }

            if (!str_starts_with($file->getFilename(), 'V')) {
                continue;
            }

            $currentApiVersion = (int) str_replace('V', '', $file->getFilename());
            if ($currentApiVersion > $highestApiVersion) {
                $highestApiVersion = $currentApiVersion;
            }
        }

        $this->highestApiVersion = $highestApiVersion;
        $this->nextApiVersion = $highestApiVersion + 1;

        $sourceDirectory = [
            $this->apiDirectoryPath,
            sprintf('V%s', $this->highestApiVersion),
        ];

        $destinationDirectory = [
            $this->apiDirectoryPath,
            sprintf('V%s', $this->nextApiVersion),
        ];
        $this->highestApiVersionDirectory = implode(\DIRECTORY_SEPARATOR, $sourceDirectory);
        $this->nextApiVersionDirectory = implode(\DIRECTORY_SEPARATOR, $destinationDirectory);

        return $this;
    }

    private function copyCodeFilesAndDirectories(): self
    {
        $this->info('Copying code directories and files');
        $this->copyFilesAndDirectories->copyOldToNewVersion(
            $this->highestApiVersionDirectory,
            $this->nextApiVersionDirectory
        );

        return $this;
    }

    private function copyLanguageFilesAndDirectories(): self
    {
        $this->info('Copying language directories and files');
        $sourceFolder = [
            base_path('resources'),
            'lang',
            'en',
            sprintf('v%s', $this->highestApiVersion),
        ];
        $sourceFolder = implode(\DIRECTORY_SEPARATOR, $sourceFolder);

        $destinationDirectory = [
            base_path('resources'),
            'lang',
            'en',
            sprintf('v%s', $this->nextApiVersion),
        ];
        $destinationDirectory = implode(\DIRECTORY_SEPARATOR, $destinationDirectory);

        $this->copyFilesAndDirectories->copyOldToNewVersion(
            $sourceFolder,
            $destinationDirectory,
        );

        return $this;
    }

    private function replaceApiVersionInFiles(): self
    {
        $this->info('Replacing api version in files');
        $this->replaceApiVersionInFiles->replaceVersion(
            $this->nextApiVersionDirectory,
            $this->highestApiVersion,
            $this->nextApiVersion
        );

        return $this;
    }
}
