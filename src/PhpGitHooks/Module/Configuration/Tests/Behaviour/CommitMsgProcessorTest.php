<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\CommitMsgProcessor;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\CommitMsgStub;

class CommitMsgProcessorTest extends ConfigurationUnitTestCase
{
    /**
     * @var CommitMsgProcessor
     */
    private $commitMsgProcessor;

    protected function setUp()
    {
        $this->commitMsgProcessor = new CommitMsgProcessor();
    }

    /**
     * @test
     */
    public function itShouldDisableHook()
    {
        $this->shouldAsk(HookQuestions::COMMIT_MSG_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, 'n');
        
        $commitMsg = $this->commitMsgProcessor->process(CommitMsgStub::setUndefined(), $this->getIOInterface());

        $this->assertFalse($commitMsg->isUndefined());
        $this->assertFalse($commitMsg->isEnabled());
        $this->assertNull($commitMsg->getRegularExpression()->value());
    }
}
