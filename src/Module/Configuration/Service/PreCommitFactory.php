<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PreCommit;
use Module\Configuration\Domain\Undefined;

class PreCommitFactory
{
    /**
     * @param array $data
     *
     * @return PreCommit
     */
    public static function fromArray(array $data)
    {
        return new PreCommit(
            new Undefined(false),
            new Enabled($data['enabled']),
            ExecuteFactory::fromArray($data['process']),
            isset($data['messages']) ? MessagesFactory::fromArray($data['messages']) : MessagesFactory::setUndefined()
        );
    }

    /**
     * @return PreCommit
     */
    public static function setUndefined()
    {
        return new PreCommit(
            new Undefined(true),
            new Enabled(false),
            ExecuteFactory::setUndefined(),
            MessagesFactory::setUndefined()
        );
    }
}
