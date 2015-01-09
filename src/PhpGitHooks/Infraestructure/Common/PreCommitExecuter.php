<?php


namespace PhpGitHooks\Infraestructure\Common;

use PhpGitHooks\Infraestructure\Config\PreCommitConfig;

/**
 * Class PreCommitExecuter
 * @package PhpGitHooks\Infraestructure\Common
 */
abstract class PreCommitExecuter
{
    /** @var PreCommitConfig  */
    protected $preCommitConfig;

    /**
     * @param PreCommitConfig $preCommitConfig
     */
    public function __construct(PreCommitConfig $preCommitConfig)
    {
        $this->preCommitConfig = $preCommitConfig;
    }

    /**
     * @return bool
     */
    protected function isEnabled()
    {
        return $this->preCommitConfig->isEnabled($this->commandName());
    }

    /**
     * @return string
     */
    abstract protected function commandName();
}
