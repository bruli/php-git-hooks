<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FileCopier;
use PhpGitHooks\Infrastructure\Git\HooksFileCopier;

/**
 * Class CommitMsgProcessor
 * @package PhpGitHooks\Application\Composer
 */
class CommitMsgProcessor extends Processor implements ProcessorHook
{
    const HOOK_NAME = 'commit-msg';
    /** @var HooksFileCopier  */
    private $hooksFileCopier;
    /** @var  array */
    private $preCommitData = array();

    /**
     * @param FileCopier $hooksFileCopier
     */
    public function __construct(FileCopier $hooksFileCopier)
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
            $enabled = true;
        }

        $this->preCommitData[self::HOOK_NAME] = ['enabled' => $enabled];
    }
}
