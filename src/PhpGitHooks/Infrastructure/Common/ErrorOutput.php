<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Command\BadJobLogo;

class ErrorOutput
{
    /**
     * @param $errorText
     *
     * @return string
     */
    public static function write($errorText)
    {
        return BadJobLogo::paint($errorText);
    }
}
