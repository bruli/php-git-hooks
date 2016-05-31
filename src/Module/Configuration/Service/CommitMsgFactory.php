<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\RegularExpression;
use Module\Configuration\Domain\Undefined;

class CommitMsgFactory
{
    /**
     * @param array $data
     *
     * @return CommitMsg
     */
    public static function fromArray(array $data)
    {
        return  new CommitMsg(
            new Undefined(false),
            new Enabled($data['enabled']),
            new RegularExpression($data['regular-expression'])
        );
    }

    /**
     * @return CommitMsg
     */
    public static function setUndefined()
    {
        return new CommitMsg(
            new Undefined(true),
            new Enabled(false),
            new RegularExpression(null)
        );
    }
}
