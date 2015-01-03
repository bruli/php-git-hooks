<?php

namespace Infraestructure\CommitMessage;

use Mockery\Mock;
use PhpGitHooks\Infraestructure\CommitMessage\CommitMessageValidator;
use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infraestructure\CommitMessage\InvalidCommitMessageException;
use PhpGitHooks\Infraestructure\Git\MergeValidator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpGitHooks\Infraestructure\CommitMessage\ExtractCommitMessage;

/**
 * Class CommitMessageValidatorTest
 * @package Infraestructure\CommitMessage
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
        $this->outputHandler = \Mockery::mock(OutputHandler::class);
        $this->outputHandler->shouldReceive('setTitle');
        $this->outputHandler->shouldReceive('getTitle');
        $this->outputHandler->shouldReceive('getSuccessfulStepMessage')->andReturn('Ok');
        $this->inputInterface = \Mockery::mock(InputInterface::class);
        $this->inputInterface->shouldReceive('getFirstArgument')->andReturn('commit_file');
        $this->outputInterface = \Mockery::mock(OutputInterface::class);
        $this->mergeValidator = \Mockery::mock(MergeValidator::class);
        $this->mergeValidator->shouldReceive('isMerge')->andReturn(false);
        $this->extractCommitMessage = \Mockery::mock(ExtractCommitMessage::class);

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
        $this->setExpectedException(InvalidCommitMessageException::class);

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
