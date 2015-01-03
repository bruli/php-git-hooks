<?php

namespace PhpGitHooks\Command;

use PhpGitHooks\Container;
use PhpGitHooks\Infraestructure\CommitMessage\CommitMessageValidator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QualityMessageTool
 * @package PhpGitHooks\Command
 */
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \PhpGitHooks\Infraestructure\CommitMessage\InvalidCommitMessageException
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