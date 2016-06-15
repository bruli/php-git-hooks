<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\Messages;

class MessagesFactory
{
    /**
     * @param array $data
     *
     * @return Messages
     */
    public static function fromArray(array $data)
    {
        return new Messages(
            new Message($data['right-message']),
            new Message($data['error-message'])
        );
    }

    /**
     * @return Messages
     */
    public static function setUndefined()
    {
        return new Messages(
            new Message(null),
            new Message(null)
        );
    }
}
