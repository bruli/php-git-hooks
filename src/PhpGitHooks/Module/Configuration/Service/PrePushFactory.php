<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PrePushFactory
{
    /**
     * @return PrePush
     */
    public static function setUndefined()
    {
        return new PrePush(
            new Undefined(true),
            new Enabled(false),
            PrePushExecuteFactory::setUndefined(),
            MessagesFactory::setUndefined()
        );
    }

    /**
     * @param array $data
     *
     * @return PrePush
     */
    public static function fromArray(array $data)
    {
        return new PrePush(
            new Undefined(false),
            new Enabled($data['enabled']),
            PrePushExecuteFactory::fromArray($data['execute']),
            isset($data['messages']) ? MessagesFactory::fromArray($data['messages']) : MessagesFactory::setUndefined()
        );
    }
}
