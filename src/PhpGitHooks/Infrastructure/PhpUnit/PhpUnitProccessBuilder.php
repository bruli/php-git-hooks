<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitProccessBuilder
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitProccessBuilder
{
    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        return new ProcessBuilder(array('php', 'bin/phpunit'));
    }
}
