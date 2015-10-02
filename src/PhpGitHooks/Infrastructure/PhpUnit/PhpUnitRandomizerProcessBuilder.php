<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

final class PhpUnitRandomizerProcessBuilder extends PhpUnitProcessBuilder
{
    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        return new ProcessBuilder(array('php', PHPGITHOOKS_BIN_DIR . '/phpunit-randomizer', '--order', 'rand'));
    }
}
