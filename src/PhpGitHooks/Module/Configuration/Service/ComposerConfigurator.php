<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Composer;
use PhpGitHooks\Module\Configuration\Domain\Enabled;

class ComposerConfigurator
{
    /**
     * @param IOInterface $io
     * @param Composer    $composer
     *
     * @return Composer
     */
    public static function configure(IOInterface $io, Composer $composer)
    {
        if (true === $composer->isUndefined()) {
            $answer = $io->ask(HookQuestions::COMPOSER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);
            $composer = $composer
                ->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));
        }

        return $composer;
    }
}
