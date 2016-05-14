<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Composer\ProcessorInterface;

class PrePushProcessor extends PreQualityToolProcessor implements ProcessorInterface
{
    /**
     * @return string
     */
    public function hookName()
    {
        return 'pre-push';
    }
}
