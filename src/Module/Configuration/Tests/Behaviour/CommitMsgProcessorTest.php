<?php

namespace Module\Configuration\Tests\Behaviour;

use Composer\IO\IOInterface;
use Module\Configuration\Service\CommitMsgProcessor;
use Module\Configuration\Service\HookQuestions;
use Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use Module\Configuration\Tests\Stub\CommitMsgStub;

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

    /**
     * @test
     */
    public function itShouldNotSetAnyQuestion()
    {
        $commitMsgData = CommitMsgStub::random();

        $commitMsg = $this->commitMsgProcessor->process($commitMsgData, $this->getIOInterface());

        $this->assertSame($commitMsgData->isUndefined(), $commitMsg->isUndefined());
        $this->assertSame($commitMsgData->isEnabled(), $commitMsg->isEnabled());
        $this->assertSame($commitMsgData->getRegularExpression(), $commitMsg->getRegularExpression());
    }
}
