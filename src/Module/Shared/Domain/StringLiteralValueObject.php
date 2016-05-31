<?php

namespace Module\Shared\Domain;

use Module\Shared\Contract\Exception\InvalidStringException;

abstract class StringLiteralValueObject extends AbstractValueObject
{
    /**
     * @param string $value
     *
     * @return bool|void
     * @throws InvalidStringException
     */
    protected function guard($value)
    {
        if (false === is_string($value)) {
            throw new InvalidStringException($value);
        }
    }
}
