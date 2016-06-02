<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

/**
 * Class PHPMDViolationsException.
 */
class PHPMDViolationsException extends \Exception
{
    protected $message = "There are PHPMD violations!\n";

    public function __construct($message = "")
    {
        $this->message .= $message;
    }
}
