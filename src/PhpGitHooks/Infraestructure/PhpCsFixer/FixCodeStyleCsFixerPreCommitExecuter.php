<?php


namespace PhpGitHooks\Infraestructure\PhpCsFixer;

use PhpGitHooks\Infraestructure\Common\PreCommitExecuter;
use PhpGitHooks\Infraestructure\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FixCodeStyleCsFixerPreCommitExecuter
 * @package PhpGitHooks\Infraestructure\PhpCsFixer
 */
class FixCodeStyleCsFixerPreCommitExecuter extends PreCommitExecuter
{
    /** @var  PhpCsFixerHandler */
    private $phpCsFixerHandler;

    /**
     * @param PreCommitConfig   $preCommitConfig
     * @param PhpCsFixerHandler $csFixerHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpCsFixerHandler $csFixerHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->phpCsFixerHandler = $csFixerHandler;
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'php-cs-fixer';
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     * @param string          $needle
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        if ($this->isEnabled()) {
            $this->phpCsFixerHandler->setOutput($output);
            $this->phpCsFixerHandler->setFiles($files);
            $this->phpCsFixerHandler->setFilesToAnalize($needle);
            $this->phpCsFixerHandler->run();
        }
    }
}
