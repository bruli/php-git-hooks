<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpValueObjects\NullableInterface;
use PhpValueObjects\Scalar\StringLiteral;

class RegularExpression extends StringLiteral implements NullableInterface
{
}
