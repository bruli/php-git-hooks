<?php

namespace Module\Configuration\Domain;

use Module\Shared\Domain\StringLiteralValueObject;
use Module\Shared\Model\NullableInterface;

class Message extends StringLiteralValueObject implements NullableInterface
{
}
