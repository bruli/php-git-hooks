<?php

namespace PhpGitHooks\Infrastructure\Hook;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use PhpGitHooks\Module\Git\Contract\Command\PreCommitTool;
use PhpGitHooks\Module\Git\Contract\Command\PreCommitToolCommandHandler;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PreCommit.
 *
 * @codingStandardsIgnoreFile
 */
class PreCommit extends Application
{
    /**
     * @var AppKernel
     */
    private $container;

    /**
     * PreCommit constructor.
     */
    public function __construct()
    {
        $appKernel = new AppKernel('dev', true);
        $appKernel->boot();
        $this->container = $appKernel->getContainer();
        parent::__construct('pre-commit');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var PreCommitToolCommandHandler
         */
        $command = $this->container->get('bruli.command.bus');
        $command->handle(new PreCommitTool());
    }
}
