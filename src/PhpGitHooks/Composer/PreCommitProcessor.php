<?php

namespace PhpGitHooks\Composer;

use PhpGitHooks\Infraestructure\Git\HooksFileCopier;

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
            HooksFileCopier::copy('pre-commit');
            $enabled = true;
        }
        $this->preCommitData['pre-commit'] = ['enabled' => $enabled];
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
