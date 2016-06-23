<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class MessageStub implements RandomStubInterface
{
    /**
     * @param $value
     *
     * @return Message
     */
    public static function create($value)
    {
        return new Message($value);
    }

    /**
     * @return Message
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->word);
    }
}
