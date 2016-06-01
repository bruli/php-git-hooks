<?php

namespace Module\Configuration\Tests\Behaviour;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Execute;
use Module\Configuration\Service\HookQuestions;
use Module\Configuration\Service\PreCommitProcessor;
use Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use Module\Configuration\Tests\Stub\PreCommitStub;

class PreCommitProcessorTest extends ConfigurationUnitTestCase
{
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var IOInterface
     */
    private $io;

    protected function setUp()
    {
        $this->io = $this->getIOInterface();
        $this->preCommitProcessor = new PreCommitProcessor();
    }

    /**
     * @test
     */
    public function itShouldDisablePreCommitHook()
    {
        $this->shouldAsk(HookQuestions::PRE_COMMIT_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, 'n');

        $preCommitData = $this->preCommitProcessor->process(PreCommitStub::createUndefined(), $this->io);

        $this->assertFalse($preCommitData->isEnabled());
        $this->assertFalse($preCommitData->isUndefined());
        $this->assertNull($preCommitData->getMessages()->getRightMessage()->value());
        $this->assertNull($preCommitData->getMessages()->getErrorMessage()->value());

        /** @var Execute $execute */
        $execute = $preCommitData->getExecute();
        $tools = $execute->execute();

        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];

        $this->assertFalse($composer->isEnabled());
        $this->assertFalse($composer->isUndefined());
        $this->assertFalse($jsonLint->isEnabled());
        $this->assertFalse($jsonLint->isUndefined());
        $this->assertFalse($phpLint->isEnabled());
        $this->assertFalse($phpLint->isUndefined());
    }
}
