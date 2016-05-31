<?php


namespace Module\Shared\Domain;


use Module\Shared\Contract\Exception\InvalidBooleanException;

abstract class BooleanValueObject extends AbstractValueObject
{
    protected function guard($value)
    {
        if (false === is_bool($value)) {
            throw new InvalidBooleanException($value);
        }
    }
}