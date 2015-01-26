<?php

namespace Infrastructure\CommitMessage;

use Mockery\Mock;
use PhpGitHooks\Infrastructure\CommitMessage\CommitMessageValidator;

/**
 * Class CommitMessageValidatorTest
 * @package Infrastructure\CommitMessage
 */
class CommitMessageValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CommitMessageValidator */
    private $commitMessageValidator;
    /** @var  Mock */
    private $outputHandler;
    /** @var  Mock */
    private $inputInterface;
    /** @var  Mock */
    private $outputInterface;
    /** @var  Mock */
    private $mergeValidator;
    /** @var  Mock */
    private $extractCommitMessage;

    protected function setUp()
    {
        $this->outputHandler = \Mockery::mock('PhpGitHooks\Command\OutputHandler');
        $this->outputHandler->shouldReceive('setTitle');
        $this->outputHandler->shouldReceive('getTitle');
        $this->outputHandler->shouldReceive('getSuccessfulStepMessage')->andReturn('Ok');
        $this->inputInterface = \Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $this->inputInterface->shouldReceive('getFirstArgument')->andReturn('commit_file');
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->mergeValidator = \Mockery::mock('PhpGitHooks\Infrastructure\Git\MergeValidator');
        $this->mergeValidator->shouldReceive('isMerge')->andReturn(false);
        $this->extractCommitMessage = \Mockery::mock('PhpGitHooks\Infrastructure\CommitMessage\ExtractCommitMessage');

        $this->commitMessageValidator = new CommitMessageValidator(
            $this->outputHandler,
            $this->mergeValidator,
            $this->extractCommitMessage
        );
    }

    /**
     * @test
     */
    public function invalidCommitMessageReturnsException()
    {
        $this->setExpectedException('\PhpGitHooks\Infrastructure\CommitMessage\InvalidCommitMessageException');

        $this->extractCommitMessage->shouldReceive('extract')->andReturn('invalid commit message');

        $this->commitMessageValidator->setInput($this->inputInterface);
        $this->commitMessageValidator->setOutput($this->outputInterface);
        $this->commitMessageValidator->validate();
    }

    /**
     * @test
     */
    public function validCommitMessage()
    {
        $this->extractCommitMessage->shouldReceive('extract')->andReturn('#0111 valid commit message');

        $this->commitMessageValidator->setInput($this->inputInterface);
        $this->commitMessageValidator->setOutput($this->outputInterface);
        $this->assertEquals(null, $this->commitMessageValidator->validate());
    }
}
