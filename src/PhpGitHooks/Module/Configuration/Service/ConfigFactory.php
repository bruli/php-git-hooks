<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Config;

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
        $prePush = false === array_key_exists('pre-push', $data) ?
            PrePushFactory::setUndefined() : PrePushFactory::fromArray($data['pre-push']);

        return new Config($preCommit, $commitMsg, $prePush);
    }
}
