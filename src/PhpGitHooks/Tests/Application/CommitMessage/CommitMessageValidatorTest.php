<?php

namespace PhpGitHooks\Tests\Application\CommitMessage;

use PhpGitHooks\Application\CommitMessage\CommitMessageValidator;
use PhpGitHooks\Application\Config\ConfigFile;
use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infrastructure\Common\InMemoryFileExtractInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryInputInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Git\InMemoryMergeValidator;

/**
 * Class CommitMessageValidatorTest
 * @package Infrastructure\CommitMessage
 */
class CommitMessageValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CommitMessageValidator */
    private $commitMessageValidator;
    /** @var  OutputHandler */
    private $outputHandler;
    /** @var  InMemoryInputInterface */
    private $inputInterface;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;
    /** @var  InMemoryMergeValidator */
    private $mergeValidator;
    /** @var  InMemoryFileExtractInterface */
    private $extractCommitMessage;
    /** @var  PhpGitHooks\Application\Config\ConfigFile Mock */
    private $configFileMock;

    protected function setUp()
    {
        $this->outputHandler = new OutputHandler();
        $this->inputInterface = new InMemoryInputInterface();
        $this->inputInterface->setFirstArgument('commit_file');
        $this->outputInterface = new InMemoryOutputInterface();
        $this->mergeValidator = new InMemoryMergeValidator();
        $this->mergeValidator->setMerge(false);
        $this->extractCommitMessage = new InMemoryFileExtractInterface();
        $this->configFileMock = $this->getMockBuilder('PhpGitHooks\Application\Config\ConfigFile')
            ->disableOriginalConstructor()
            ->getMock();

        $this->commitMessageValidator = new CommitMessageValidator(
            $this->outputHandler,
            $this->mergeValidator,
            $this->extractCommitMessage,
            $this->configFileMock
        );
    }

    /**
     * @test
     */
    public function invalidCommitMessageReturnsException()
    {
        $this->setExpectedException('\PhpGitHooks\Application\CommitMessage\InvalidCommitMessageException');
        $this->configFileMock->expects($this->once())->method('getMessageCommitConfiguration')->willReturn(array('regular-expression' => '#[0-9]{2,7}'));

        $this->extractCommitMessage->setExtract('invalid commit message');

        $this->commitMessageValidator->setInput($this->inputInterface);
        $this->commitMessageValidator->setOutput($this->outputInterface);
        $this->commitMessageValidator->validate();
    }

    /**
     * @test
     */
    public function validCommitMessage()
    {
        $this->configFileMock->expects($this->once())->method('getMessageCommitConfiguration')->willReturn(array('regular-expression' => '#[0-9]{2,7}'));

        $this->extractCommitMessage->setExtract('#0111 valid commit message');

        $this->commitMessageValidator->setInput($this->inputInterface);
        $this->commitMessageValidator->setOutput($this->outputInterface);
        $this->assertEquals(null, $this->commitMessageValidator->validate());
    }
}
