<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use PhpValueObjects\NullableInterface;
use PhpValueObjects\Scalar\StringLiteral;

class PhpCsStandard extends StringLiteral implements NullableInterface
{
    /**
     * @param string $value
     *
     * @return bool|void
     *
     * @throws InvalidPhpCsStandardException
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
