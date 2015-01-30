<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FileCopierInterface;
use PhpGitHooks\Infrastructure\Git\HooksFileCopier;

/**
 * Class PreCommitProcessor
 * @package PhpGitHooks\Application\Composer
 */
class PreCommitProcessor extends Processor implements ProcessorHookInterface
{
    private $preCommitData = array();
    private $preCommitTools = array('phpunit', 'phplint', 'php-cs-fixer', 'phpcs', 'phpmd');
    /** @var  HooksFileCopier */
    private $hooksFileCopier;

    /**
     * @param HooksFileCopier $hooksFileCopier
     */
    public function __construct(FileCopierInterface $hooksFileCopier)
    {
        $this->hooksFileCopier = $hooksFileCopier;
    }

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
            $this->hooksFileCopier->copy('pre-commit');
            $enabled = true;
        }
        $this->preCommitData['pre-commit'] = array('enabled' => $enabled);
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
