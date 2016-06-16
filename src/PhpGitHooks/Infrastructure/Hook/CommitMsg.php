<?php

namespace PhpGitHooks\Infrastructure\Hook;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use PhpGitHooks\Module\Git\Contract\Command\CommitMsgCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommitMsg extends Application
{
    /**
     * @var AppKernel
     */
    private $container;

    public function __construct()
    {
        $this->container = new AppKernel();
        parent::__construct('commit-msg');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->container->get('command.bus')
            ->handle(new CommitMsgCommand($input));
    }
}
