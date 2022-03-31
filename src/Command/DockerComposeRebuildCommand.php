<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class DockerComposeRebuildCommand extends AbstractDockerComposeCommand
{
    protected static $defaultName = 'app:docker-compose-rebuild';
    protected static $defaultDescription = 'Rebuild docker container in accord with current environment';

    protected function configure(): void
    {
        $this
            ->addArgument('service', InputArgument::OPTIONAL, 'The service to rebuild.')
            ->setHelp(
                'Executes a docker-composer build --no-cache command using env file and docker-composer override files in \
            accord with current environment');
    }

    protected function getDockerComposerCommand(InputInterface $input): string
    {
        return sprintf(
         'docker-compose --env-file %s -f docker-compose.yml -f %s build %s --no-cache --build-arg BUILD_ENV='.$_ENV['APP_ENV'],
           $this->dockerEnvManager->getEnvFile(),
           $this->dockerEnvManager->getDockerOverrideFile(),
           $input->getArgument('service')
       );
    }
}
