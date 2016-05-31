<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\JsonLint;

class JsonLintConfigurator
{
    /**
     * @param IOInterface $io
     * @param JsonLint    $jsonLint
     *
     * @return JsonLint
     */
    public static function configure(IOInterface $io, JsonLint $jsonLint)
    {
        if (true === $jsonLint->isUndefined()) {
            $answer = $io->ask(HookQuestions::JSONLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);
            $jsonLint = $jsonLint->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));
        }

        return $jsonLint;
    }
}
