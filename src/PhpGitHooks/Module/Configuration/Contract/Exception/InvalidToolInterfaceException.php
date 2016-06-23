<?php

namespace PhpGitHooks\Module\Configuration\Contract\Exception;

class InvalidToolInterfaceException extends \Exception
{
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid tool interface <%s>', $value));
    }
}
