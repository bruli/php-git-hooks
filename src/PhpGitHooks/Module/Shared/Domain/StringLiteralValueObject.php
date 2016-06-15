<?php

namespace PhpGitHooks\Module\Shared\Domain;

use PhpGitHooks\Module\Shared\Contract\Exception\InvalidStringException;

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
