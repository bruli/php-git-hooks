<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;

class PhpUnitStrictCoverageConfigurator
{
    /**
     * @param IOInterface           $io
     * @param PhpUnitStrictCoverage $strictCoverage
     *
     * @return PhpUnitStrictCoverage
     */
    public static function configure(IOInterface $io, PhpUnitStrictCoverage $strictCoverage)
    {
        if (true === $strictCoverage->isUndefined()) {
            $strictCoverageAnswer = $io->ask(
                HookQuestions::PHPUNIT_STRICT_COVERAGE,
                HookQuestions::DEFAULT_TOOL_ANSWER
            );

            $strictCoverage = $strictCoverage->setEnabled(
                new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($strictCoverageAnswer))
            );

            /** @var PhpUnitStrictCoverage $strictCoverage */
            if (true === $strictCoverage->isEnabled()) {
                $minimum = $io->ask(HookQuestions::PHPUNIT_STRICT_COVERAGE_MINIMUM, 0.00);
                $strictCoverage = $strictCoverage->setStrictCoverage(new MinimumStrictCoverage((float) $minimum));
            }
        }

        return $strictCoverage;
    }
}
