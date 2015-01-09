<?php


namespace PhpGitHooks\Infraestructure\PhpLint;

use PhpGitHooks\Infraestructure\Common\PreCommitExecuter;
use PhpGitHooks\Infraestructure\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckPhpSyntaxLintPreCommitExecuter
 * @package PhpGitHooks\Infraestructure\PhpLint
 */
class CheckPhpSyntaxLintPreCommitExecuter extends PreCommitExecuter
{
    /** @var  PhpLintHandler */
    private $phpLintHandler;

    /**
     * @param PreCommitConfig $preCommitConfig
     * @param PhpLintHandler  $phpLintHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpLintHandler $phpLintHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->phpLintHandler = $phpLintHandler;
    }

    /**
     * @param  OutputInterface $output
     * @param  array           $files
     * @throws string          PhpLintException
     */
    public function run(OutputInterface $output, array $files)
    {
        if ($this->isEnabled()) {
            $this->phpLintHandler->setOutput($output);
            $this->phpLintHandler->setFiles($files);
            $this->phpLintHandler->run();
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phplint';
    }
}
