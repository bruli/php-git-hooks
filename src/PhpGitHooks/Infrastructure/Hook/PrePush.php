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
     * PrePush constructor.
     * @param string $remote
     * @param string $url
     */
    public function __construct($remote, $url)
    {
        var_export($remote);
        var_export($url);
        die;
        $this->container = new AppKernel();
        parent::__construct('pre-push');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        
    }


}