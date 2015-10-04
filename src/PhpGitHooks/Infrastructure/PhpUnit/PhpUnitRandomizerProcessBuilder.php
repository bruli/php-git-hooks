<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

if (!defined('PHPGITHOOKS_BIN_DIR')) {
    define('PHPGITHOOKS_BIN_DIR', 'bin');
}

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
