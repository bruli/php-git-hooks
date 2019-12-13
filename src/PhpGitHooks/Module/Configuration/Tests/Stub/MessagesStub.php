<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class MessagesStub implements RandomStubInterface
{
    /**
     * @param Message $rightMessage
     * @param Message $errorMessage
     * @param Enabled $enableFaces
     *
     * @return Messages
     */
    public static function create(Message $rightMessage, Message $errorMessage, Enabled $enableFaces)
    {
        return new Messages($rightMessage, $errorMessage, $enableFaces);
    }

    /**
     * @return Messages
     */
    public static function random()
    {
        return self::create(MessageStub::random(), MessageStub::random(), EnabledStub::random());
    }
}
