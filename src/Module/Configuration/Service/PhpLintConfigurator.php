<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpLint;

class PhpLintConfigurator
{
    /**
     * @param IOInterface $io
     * @param PhpLint     $phpLint
     *
     * @return PhpLint
     */
    public static function configure(IOInterface $io, PhpLint $phpLint)
    {
        if (true === $phpLint->isUndefined()) {
            $answer = $io->ask(HookQuestions::PHPLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);
            $phpLint = $phpLint->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));
        }

        return $phpLint;
    }
}
