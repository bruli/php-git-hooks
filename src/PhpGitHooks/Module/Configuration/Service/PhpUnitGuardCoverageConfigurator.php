<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;

class PhpUnitGuardCoverageConfigurator
{
    /**
     * @param IOInterface $input
     * @param PhpUnitGuardCoverage $phpUnitGuardCoverage
     *
     * @return PhpUnitGuardCoverage
     */
    public static function configure(IOInterface $input, PhpUnitGuardCoverage $phpUnitGuardCoverage)
    {
        if (true === $phpUnitGuardCoverage->isUndefined()) {
            $guardCoverageAnswer = $input->ask(
                HookQuestions::PHPUNIT_GUARD_COVERAGE,
                HookQuestions::DEFAULT_TOOL_ANSWER
            );

            $phpUnitGuardCoverage = $phpUnitGuardCoverage->setEnabled(
                new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($guardCoverageAnswer))
            );

            if (true === $phpUnitGuardCoverage->isEnabled()) {
                $defaultMessage = $input->ask(
                    HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE,
                    HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT
                );
                /** @var PhpUnitGuardCoverage $phpUnitGuardCoverage */
                $phpUnitGuardCoverage = $phpUnitGuardCoverage->setWarningMessage(
                    new Message($defaultMessage)
                );
            }
        }
            return $phpUnitGuardCoverage;
    }
}
