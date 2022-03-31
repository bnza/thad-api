<?php

namespace App\Command;

use App\Service\DockerEnvManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractDockerComposeCommand extends Command
{
    public function __construct(protected DockerEnvManager $dockerEnvManager)
    {
        parent::__construct();
    }

    abstract protected function getDockerComposerCommand(InputInterface $input): string;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = $this->getDockerComposerCommand($input);
        $output->writeln('<info>Using env</info>:'.$_ENV['APP_ENV']);
        $output->writeln('<info>Docker command</info>:'.$command);
        $returnCode = self::SUCCESS;
        passthru($command, $returnCode);

        return $returnCode;
    }
}
