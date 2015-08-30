<?php

namespace PhpGitHooks\Command;

use PhpGitHooks\Application\CommitMessage\CommitMessageValidator;
use PhpGitHooks\Container;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QualityMessageTool extends Application
{
    /** @var Container  */
    private $container;

    public function __construct()
    {
        $this->container = new Container();

        parent::__construct('Commit message Quality Tool');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \PhpGitHooks\Application\CommitMessage\InvalidCommitMessageException
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        /** @var CommitMessageValidator  $commitMessageValidator */
        $commitMessageValidator = $this->container->get('commit.message.validator');
        $commitMessageValidator->setInput($input);
        $commitMessageValidator->setOutput($output);
        $commitMessageValidator->validate();
    }
}
