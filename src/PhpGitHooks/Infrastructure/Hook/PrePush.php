<?php

namespace PhpGitHooks\Infrastructure\Hook;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $this->container = new AppKernel();
        parent::__construct('pre-push');
        $this->remote = $remote;
        $this->url = $url;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        throw new \Exception($process->isSuccessful());
    }
}
