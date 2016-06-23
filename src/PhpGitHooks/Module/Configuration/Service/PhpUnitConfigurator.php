<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitOptions;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitRandomMode;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpUnitConfigurator
{
    /**
     * @param IOInterface $io
     * @param PhpUnit $phpUnit
     *
     * @return PhpUnit
     */
    public static function configure(IOInterface $io, PhpUnit $phpUnit)
    {
        /** @var PhpUnit $phpUnit */
        if (true === $phpUnit->isUndefined()) {
            $answer = $io->ask(HookQuestions::PHPUNIT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);

            $phpUnit = $phpUnit->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

            if (true === $phpUnit->isEnabled()) {
                $randomAnswer = $io->ask(HookQuestions::PHPUNIT_RANDOM_MODE, HookQuestions::DEFAULT_TOOL_ANSWER);
                $optionsAnswer = $io->ask(HookQuestions::PHPUNIT_OPTIONS, null);

                $randomMode = new PhpUnitRandomMode(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($randomAnswer));
                $options = new PhpUnitOptions($optionsAnswer);

                $phpUnit = $phpUnit->setRandomModeAndOptions($randomMode, $options);
            }
        }

        return $phpUnit;
    }
}
