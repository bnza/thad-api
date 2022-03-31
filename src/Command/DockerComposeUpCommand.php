<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class DockerComposeUpCommand extends AbstractDockerComposeCommand
{
    protected static $defaultName = 'app:docker-compose-up';
    protected static $defaultDescription = 'Start docker containers (detached)';

    protected function configure(): void
    {
        $this
            ->addArgument('service', InputArgument::OPTIONAL, 'The service to rebuild.')
            ->setHelp(
                'Docker compose start detached containers command using env file and docker-composer override files in \
            accord with current environment');
    }

    protected function getDockerComposerCommand(InputInterface $input): string
    {
        return sprintf(
            'docker-compose --env-file %s -f docker-compose.yml -f %s up %s --detach',
            $this->dockerEnvManager->getEnvFile(),
            $this->dockerEnvManager->getDockerOverrideFile(),
            $input->getArgument('service')
        );
    }
}
