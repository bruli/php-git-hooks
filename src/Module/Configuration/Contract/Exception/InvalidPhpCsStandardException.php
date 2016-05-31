<?php

namespace Module\Configuration\Contract\Exception;

class InvalidPhpCsStandardException extends \Exception
{
    /**
     * InvalidPhpCsStandardException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid phpcs standard <%s>', $value));
    }
}
