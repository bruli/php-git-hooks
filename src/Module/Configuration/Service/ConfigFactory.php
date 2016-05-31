<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Config;

class ConfigFactory
{
    /**
     * @param array $data
     *
     * @return Config
     */
    public static function fromArray(array $data)
    {
        $preCommit = false === array_key_exists('pre-commit', $data) ?
            PreCommitFactory::setUndefined() : PreCommitFactory::fromArray($data['pre-commit']);
        $commitMsg = false === array_key_exists('commit-msg', $data) ?
            CommitMsgFactory::setUndefined() : CommitMsgFactory::fromArray($data['commit-msg']);

        return new Config($preCommit, $commitMsg);
    }
}
