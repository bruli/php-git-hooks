<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use PhpValueObjects\NullableInterface;
use PhpValueObjects\Scalar\StringLiteral;

class PhpCsStandard extends StringLiteral implements NullableInterface
{
}
