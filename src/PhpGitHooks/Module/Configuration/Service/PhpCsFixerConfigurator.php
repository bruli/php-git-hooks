<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Level;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerLevels;

class PhpCsFixerConfigurator
{
    /**
     * @param IOInterface $io
     * @param PhpCsFixer  $phpCsFixer
     *
     * @return PhpCsFixer
     */
    public static function configure(IOInterface $io, PhpCsFixer $phpCsFixer)
    {
        if (true === $phpCsFixer->isUndefined()) {
            $answer = $io->ask(HookQuestions::PHPCSFIXER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);

            $phpCsFixer = $phpCsFixer
                ->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

            if (true === $phpCsFixer->isEnabled()) {
                $psr0Answer = $io->ask(HookQuestions::PHPCSFIXER_PSR0_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER);
                $psr1Answer = $io->ask(HookQuestions::PHPCSFIXER_PSR1_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER);
                $psr2Answer = $io->ask(HookQuestions::PHPCSFIXER_PSR2_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER);
                $symfonyAnswer = $io->ask(HookQuestions::PHPCSFIXER_SYMFONY_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER);

                $phpCsFixer = $phpCsFixer->addLevels(new PhpCsFixerLevels(
                    new Level(HookQuestions::DEFAULT_TOOL_ANSWER ===  strtoupper($psr0Answer)),
                    new Level(HookQuestions::DEFAULT_TOOL_ANSWER ===  strtoupper($psr1Answer)),
                    new Level(HookQuestions::DEFAULT_TOOL_ANSWER ===  strtoupper($psr2Answer)),
                    new Level(HookQuestions::DEFAULT_TOOL_ANSWER ===  strtoupper($symfonyAnswer))
                ));
            }
        }

        return $phpCsFixer;
    }
}
