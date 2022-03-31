<?php

namespace App\Service;

class DockerEnvManager
{
    private string $envFile = '';

    private array $keyBlackList = [
        'APP_SECRET',
        'CORS_ALLOW_ORIGIN',
    ];

    public function getDockerOverrideFile(): string
    {
        return sprintf('docker-compose.%s.yml', 'prod' === $_ENV['APP_ENV'] ? 'prod' : 'override');
    }

    public function getEnvFile(): string
    {
        if (!$this->envFile) {
            $this->envFile = $this->dumpEnvToTmpFile();
        }

        return $this->envFile;
    }

    private function getEnvKeyList(): array
    {
        return array_diff(explode(',', $_ENV['SYMFONY_DOTENV_VARS']), $this->keyBlackList);
    }

    private function dumpEnvToTmpFile(): string
    {
        $envFile = @tempnam(sys_get_temp_dir(), 'thad');
        $fileContent = '';
        foreach ($this->getEnvKeyList() as $key) {
            $fileContent .= sprintf('%s=%s%s', $key, $_ENV[$key], PHP_EOL);
        }
        file_put_contents($envFile, $fileContent);

        return $envFile;
    }

    public function __destruct()
    {
        if ($this->envFile && file_exists($this->envFile)) {
            unlink($this->envFile);
        }
    }
}
