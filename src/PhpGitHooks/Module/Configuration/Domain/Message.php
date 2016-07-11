<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpValueObjects\NullableInterface;
use PhpValueObjects\Scalar\StringLiteral;

class Message extends StringLiteral implements NullableInterface
{
}
