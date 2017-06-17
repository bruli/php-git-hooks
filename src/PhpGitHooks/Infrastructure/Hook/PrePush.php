<?php

namespace PhpGitHooks\Infrastructure\Hook;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use PhpGitHooks\Module\Git\Contract\Command\PrePushToolCommand;
use PhpGitHooks\Module\Git\Contract\Command\PrePushToolCommandHandler;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PrePush.
 *
 * @codingStandardsIgnoreFile
 */
class PrePush extends Application
{
    /**
     * @var AppKernel
     */
    private $container;
    /**
     * @var string
     */
    private $remote;
    /**
     * @var string
     */
    private $url;

    /**
     * PrePush constructor.
     *
     * @param string $remote
     * @param string $url
     */
    public function __construct($remote, $url)
    {
        $appKernel = new AppKernel('dev', true);
        $appKernel->boot();
        $this->container = $appKernel->getContainer();

        parent::__construct('pre-push');
        $this->remote = $remote;
        $this->url = $url;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var PrePushToolCommandHandler
         */
        $command = $this->container->get('bruli.command.bus');
        $command->handle(new PrePushToolCommand($this->remote, $this->url));
    }
}
