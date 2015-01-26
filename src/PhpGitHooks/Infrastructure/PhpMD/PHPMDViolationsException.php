<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

/**
 * Class PHPMDViolationsException
 * @package PhpGitHooks\Infrastructure\PhpMD
 */
class PHPMDViolationsException extends \Exception
{
    protected $message = "There are PHPMD violations!\n";

    public function __construct($message)
    {
        $this->message .= $message;
    }
}
