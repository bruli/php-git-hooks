<?php

namespace PhpGitHooks\Module\Shared\Contract\Exception;

class InvalidBooleanException extends \Exception
{
    /**
     * InvalidBooleanException constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid boolean value <%s>', $value));
    }
}
