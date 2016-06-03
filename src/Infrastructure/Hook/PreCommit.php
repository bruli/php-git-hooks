<?php

namespace Infrastructure\Hook;

require_once __DIR__.'/../../../app/AppKernel.php';

use AppKernel;
use Module\Git\Service\PreCommitTool;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PreCommit extends Application
{
    /**
     * @var AppKernel
     */
    private $container;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * PreCommit constructor.
     */
    public function __construct()
    {
        $this->container = new AppKernel();
        parent::__construct('pre-commit');
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        /** @var PreCommitTool $preCommit */
        $preCommit = $this->container->get('pre.commit.tool');
        $preCommit->execute($output);
    }
}
