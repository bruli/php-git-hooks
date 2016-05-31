<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsStandard;

class PhpCsConfigurator
{
    /**
     * @param IOInterface $io
     * @param PhpCs       $phpCs
     *
     * @return PhpCs|\Module\Configuration\Model\ToolInterface
     */
    public static function configure(IOInterface $io, PhpCs $phpCs)
    {
        if (true === $phpCs->isUndefined()) {
            $answer = $io->ask(HookQuestions::PHPCS_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER);
            $phpCs = $phpCs->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

            if (true === $phpCs->isEnabled()) {
                $standardAnswer = $io->ask(HookQuestions::PHPCS_STANDARD, null);
                /** @var PhpCs $phpCs */
                $phpCs = $phpCs->addStandard(new PhpCsStandard($standardAnswer));
            }
        }

        return $phpCs;
    }
}
