<?php

namespace PhpGitHooks\Infraestructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitProccessBuilder
 * @package PhpGitHooks\Infraestructure\PhpUnit
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
