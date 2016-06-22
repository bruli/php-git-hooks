<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpMdOptions;

class PhpMdConfigurator
{
    /**
     * @param IOInterface $io
     * @param PhpMd       $phpMd
     *
     * @return PhpMd
     */
    public static function configure(IOInterface $io, PhpMd $phpMd)
    {
        if (true === $phpMd->isUndefined()) {
            $answer = $io->ask(HookQuestions::PHPMD_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);
            $phpMd = $phpMd->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));
            
            $optionsAnswer = $io->ask(HookQuestions::PHPMD_OPTIONS, null);
            $options = new PhpMdOptions($optionsAnswer);
            $phpMd = $phpMd->setOptions($options);
        }

        return $phpMd;
    }
}
