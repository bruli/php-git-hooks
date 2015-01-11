<?php

namespace PhpGitHooks\Composer;

use Symfony\Component\Process\Process;

/**
 * Class PreCommitProcessor
 * @package PhpGitHooks\Composer
 */
class PreCommitProcessor extends Processor
{
    private $preCommitData = array();
    private $preCommitTools = ['phpunit', 'phplint', 'php-cs-fixer', 'phpcs', 'phpmd'];

    /**
     * @return array
     */
    public function execute()
    {
        $this->enablePreCommit();

        foreach ($this->preCommitTools as $tool) {
            $this->enableExecutePreCommitTool($tool);
        }

        return $this->preCommitData;
    }

    private function enablePreCommit()
    {
        $enablePrecommit = $this->setQuestion(
            'Do you want enable pre-commit hook?',
            'Y/n',
            'Y'
        );

        $enabled = false;

        if ('Y' === strtoupper($enablePrecommit)) {
            $this->copyHookFile('pre-commit');
            $enabled = true;
        }
        $this->preCommitData['pre-commit'] = ['enabled' => $enabled];
    }

    /**
     * @param $hook
     */
    private function copyHookFile($hook)
    {
        if (false === file_exists('.git/hooks/'.$hook)) {
            $copy = new Process('cp '.__DIR__.'/../../../hooks/'.$hook.' .git/hooks/'.$hook);
            $copy->run();
        }
    }

    /**
     * @param $tool
     */
    private function enableExecutePreCommitTool($tool)
    {
        $execute = true;

        $executeTool = $this->setQuestion(
            sprintf('Do you want execute %s in pre-commit hook?', strtoupper($tool)),
            'Y/n',
            'Y'
        );

        if ('N' === strtoupper($executeTool)) {
            $execute = false;
        }

        $this->preCommitData['pre-commit']['execute'][$tool] = $execute;
    }
}
