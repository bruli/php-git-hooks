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
        return new ProcessBuilder(array('php', 'bin/phpunit-randomizer', '--order', 'rand'));
    }
}
