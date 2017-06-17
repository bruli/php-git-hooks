<?php

namespace PhpGitHooks\Infrastructure\Hook;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommitMsg.
 *
 * @codingStandardsIgnoreFile
 */
class CommitMsg extends Application
{
    /**
     * @var AppKernel
     */
    private $container;

    public function __construct()
    {
        $appKernel = new AppKernel('dev', true);
        $appKernel->boot();
        $this->container = $appKernel->getContainer();
        parent::__construct('commit-msg');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->container->get('bruli.command.bus')
            ->handle(new \PhpGitHooks\Module\Git\Contract\Command\CommitMsg($input));
    }
}
