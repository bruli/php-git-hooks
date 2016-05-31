<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use Module\Shared\Domain\StringLiteralValueObject;
use Module\Shared\Model\NullableInterface;

class PhpCsStandard extends StringLiteralValueObject implements NullableInterface
{
    /**
     * @param string $value
     *
     * @return bool|void
     *
     * @throws InvalidPhpCsStandardException
     * @throws \Module\Shared\Contract\Exception\InvalidStringException
     */
    protected function guard($value)
    {
        parent::guard($value);

        $standard = ['PSR1','PSR2', 'PHPCS', 'MySource', 'Zend', 'Squiz', 'PEAR'];

        if (false === in_array($value, $standard)) {
            throw new InvalidPhpCsStandardException($value);
        }
    }
}
