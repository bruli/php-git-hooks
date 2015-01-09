<?php


namespace PhpGitHooks\Infraestructure\PhpUnit;

use PhpGitHooks\Infraestructure\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UnitTestPreCommitExecuter
 * @package PhpGitHooks\Infraestructure\PhpUnit
 */
class UnitTestPreCommitExecuter
{
    /** @var PreCommitConfig  */
    private $preCommitConfig;

    private $phpunitHandler;

    /**
     * @param PreCommitConfig $preCommitConfig
     * @param PhpUnitHandler  $phpUnitHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpUnitHandler $phpUnitHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->phpunitHandler = $phpUnitHandler;
    }

    /**
     * @param  OutputInterface    $outputInterface
     * @throws UnitTestsException
     */
    public function run(OutputInterface $outputInterface)
    {
        if ($this->isEnabled()) {
            $this->phpunitHandler->setOutput($outputInterface);
            $this->phpunitHandler->run();
        }
    }

    /**
     * @return bool
     */
    private function isEnabled()
    {
        return $this->preCommitConfig->isEnabled('phpunit');
    }
}
