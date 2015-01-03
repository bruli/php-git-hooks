<?php

namespace PhpGitHooks\Infraestructure\PhpMD;

use Exception;

/**
 * Class PHPMDViolationsException
 * @package PhpGitHooks\Infraestructure\PhpMD
 */
class PHPMDViolationsException extends \Exception
{
    protected $message = "There are PHPMD violations!\n";

    public function __construct($message)
    {
        $this->message .= $message;
    }
}
