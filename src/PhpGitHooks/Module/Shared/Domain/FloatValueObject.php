<?php

namespace PhpGitHooks\Module\Shared\Domain;

use PhpGitHooks\Module\Shared\Contract\Exception\InvalidFloatException;

class FloatValueObject extends AbstractValueObject
{
    /**
     * @param float $value
     *
     * @return bool|void
     *
     * @throws InvalidFloatException
     */
    protected function guard($value)
    {
        if (false === is_float($value)) {
            throw new InvalidFloatException($value);
        }
    }
}
