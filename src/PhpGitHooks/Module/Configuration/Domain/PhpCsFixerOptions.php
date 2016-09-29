<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpValueObjects\NullableInterface;
use PhpValueObjects\Scalar\StringLiteral;

class PhpCsFixerOptions extends StringLiteral implements NullableInterface
{
}
