<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Configuration\Model\ExecuteInterface;
use PhpGitHooks\Module\Configuration\Service\ExecuteFactory;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PreCommitStub implements RandomStubInterface
{
    /**
     * @param Undefined        $undefined
     * @param Enabled          $enabled
     * @param ExecuteInterface $execute
     * @param Messages         $messages
     *
     * @return PreCommit
     */
    public static function create(
        Undefined $undefined,
        Enabled $enabled,
        ExecuteInterface $execute,
        Messages $messages
    ) {
        return new PreCommit(
            $undefined,
            $enabled,
            $execute,
            $messages
        );
    }

    /**
     * @return PreCommit
     */
    public static function createUndefined()
    {
        return self::create(
            new Undefined(true),
            new Enabled(false),
            ExecuteFactory::setUndefined(),
            MessagesStub::random()
        );
    }

    /**
     * @return PreCommit
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            ExecuteStub::create(
                ComposerStub::random(),
                JsonLintStub::random(),
                PhpLintStub::random(),
                PhpMdStub::random(),
                PhpCsStub::random(),
                PhpCsFixerStub::random(),
                PhpUnitStub::random()
            ),
            MessagesStub::random()
        );
    }
}
