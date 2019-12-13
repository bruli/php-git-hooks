<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
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
            new Message(isset($data['right-message']) ? $data['right-message'] : ''),
            new Message(isset($data['error-message']) ? $data['error-message'] : ''),
            new Enabled(isset($data['error-message']) ? (bool)$data['error-message'] : true)
        );
    }

    /**
     * @return Messages
     */
    public static function setUndefined()
    {
        return new Messages(
            new Message(null),
            new Message(null),
            new Enabled(true)
        );
    }
}
