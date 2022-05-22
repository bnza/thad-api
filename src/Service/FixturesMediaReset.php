<?php

namespace App\Service;

class FixturesMediaReset
{
    public function __construct(private readonly string $sourcePath, private readonly string $destPath)
    {
    }

    public function getSourcePath(): string
    {
        return $this->sourcePath;
    }

    public function getDestinationPath(): string
    {
        return $this->destPath;
    }

    public function load(string $env): int
    {
        if ('prod' === $env) {
            throw new \DomainException('This service cannot be executed in prod environment');
        }

        if (!file_exists($this->sourcePath)) {
            throw new \RuntimeException("source dir '$this->sourcePath' directory does not exists");
        }
        if (!is_readable($this->sourcePath)) {
            throw new \RuntimeException("source dir '$this->sourcePath' directory is not readable");
        }
        if (!file_exists($this->destPath)) {
            if ('test' === $_ENV['APP_ENV']) {
                system("mkdir -p $this->destPath", $resultCode);
                if ($resultCode) {
                    throw new \RuntimeException("failed to create destination dir $this->destPath. Code [$resultCode]");
                }
            } else {
                throw new \RuntimeException("destination dir '$this->destPath' directory does not exists");
            }
        }
        if (!is_writable($this->sourcePath)) {
            throw new \RuntimeException("destination dir '$this->destPath' directory is not writable");
        }

        system("rm -fr $this->destPath/*", $resultCode);
        if ($resultCode) {
            throw new \RuntimeException("failed to remove old files. Code [$resultCode]");
        }

        system("cp -r $this->sourcePath/* $this->destPath", $resultCode);

        if ($resultCode) {
            throw new \RuntimeException("failed to copy new. Code [$resultCode]");
        }

        return $resultCode;
    }
}
