<?php

namespace Module\Shared\Contract\Exception;

class InvalidStringException extends \Exception
{
    /**
     * InvalidStringException constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid string value object <%s>', $value));
    }
}
