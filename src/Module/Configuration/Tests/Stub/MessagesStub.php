<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Message;
use Module\Configuration\Domain\Messages;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

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
