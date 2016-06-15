<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class MessagesStub implements RandomStubInterface
{
    /**
     * @param Message $rightMessage
     * @param Message $errorMessage
     *
     * @return Messages
     */
    public static function create(
        Message $rightMessage,
        Message $errorMessage
    ) {
        return new Messages($rightMessage, $errorMessage);
    }

    /**
     * @return Messages
     */
    public static function random()
    {
        return self::create(MessageStub::random(), MessageStub::random());
    }
}
