<?php

namespace PhpGitHooks\Tests\Application\CommitMessage;

use Mockery\Mock;
use PhpGitHooks\Application\CommitMessage\CommitMessageValidator;
use PhpGitHooks\Application\CommitMessage\InvalidCommitMessageException;
use PhpGitHooks\Application\Config\ConfigFile;
use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infrastructure\Common\InMemoryFileExtractInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryInputInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Git\InMemoryMergeValidator;

/**
 * Class CommitMessageValidatorTest.
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
    /** @var  Mock */
    private $configFile;

    protected function setUp()
    {
        $this->outputHandler = new OutputHandler();
        $this->inputInterface = new InMemoryInputInterface();
        $this->inputInterface->setFirstArgument('commit_file');
        $this->outputInterface = new InMemoryOutputInterface();
        $this->mergeValidator = new InMemoryMergeValidator();
        $this->mergeValidator->setMerge(false);
        $this->extractCommitMessage = new InMemoryFileExtractInterface();
        $this->configFile = \Mockery::mock(ConfigFile::class);
        $this->configFile->shouldReceive('getMessageCommitConfiguration')
            ->andReturn(array('regular-expression' => '#[0-9]{2,7}', 'enabled' => true));

        $this->commitMessageValidator = new CommitMessageValidator(
            $this->outputHandler,
            $this->mergeValidator,
            $this->extractCommitMessage,
            $this->configFile
        );
    }

    /**
     * @test
     */
    public function invalidCommitMessageReturnsException()
    {
        $this->setExpectedException(InvalidCommitMessageException::class);

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
        $this->extractCommitMessage->setExtract('#0111 valid commit message');

        $this->commitMessageValidator->setInput($this->inputInterface);
        $this->commitMessageValidator->setOutput($this->outputInterface);
        $this->assertEquals(null, $this->commitMessageValidator->validate());
    }
}
