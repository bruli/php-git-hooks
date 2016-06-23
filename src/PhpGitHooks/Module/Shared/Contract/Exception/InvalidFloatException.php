<?php

namespace PhpGitHooks\Module\Shared\Contract\Exception;

class InvalidFloatException extends \Exception
{
    /**
     * InvalidFloatException constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid float value object <%s>', $value));
    }
}
