<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FileCopierInterface;
use PhpGitHooks\Infrastructure\Git\HooksFileCopier;

/**
 * Class CommitMsgProcessor.
 */
class CommitMsgProcessor extends Processor implements ProcessorHookInterface
{
    const HOOK_NAME = 'commit-msg';
    /** @var HooksFileCopier */
    private $hooksFileCopier;
    /** @var  array */
    private $preCommitData = array();

    /**
     * @param FileCopierInterface $hooksFileCopier
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
        $this->enableHook();

        return $this->preCommitData;
    }

    private function enableHook()
    {
        $enable = $this->setQuestion('Do you want enable commit-msg hook?', 'Y/n', 'Y');

        $enabled = false;

        if ('Y' === strtoupper($enable)) {
            $this->hooksFileCopier->copy(self::HOOK_NAME);
            $this->regularExpression();
            $enabled = true;
        }

        $this->preCommitData[self::HOOK_NAME]['enabled'] = $enabled;
    }

    private function regularExpression()
    {
        $expression = $this
            ->setQuestion('Write a regular expression for commit-msg hook. ', '#[0-9]{2,7}', '#[0-9]{2,7}');

        $this->preCommitData[self::HOOK_NAME]['regular-expression'] = $expression;
    }
}
