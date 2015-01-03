<?php

namespace PhpGitHooks\Tests\Command;

use PhpGitHooks\Command\OutputHandler;

/**
 * Class OutputHandlerTest
 * @package PhpGitHooks\Tests\Command
 */
class OutputHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  OutputHandler */
    private $outputTitleHandler;

    protected function setUp()
    {
        $this->outputTitleHandler = new OutputHandler();
    }

    /**
     * @test
     */
    public function titleRetunsValidLength()
    {
        $this->outputTitleHandler->setTitle('title test');

        $this->assertSame(OutputHandler::MAX_LENGTH+13, strlen($this->outputTitleHandler->getTitle()));
    }

    /**
     * @test
     */
    public function errorHasValidFormat()
    {
        $this->outputTitleHandler->setError('error test');

        $this->assertSame('<error>error test</error>', $this->outputTitleHandler->getError());
    }

    /**
     * @test
     */
    public function getSuccessfulStepMessageIsValidFormat()
    {
        $message = $this->outputTitleHandler->getSuccessfulStepMessage('Perfect');

        $this->assertEquals('<comment>Perfect</comment>', $message);
    }

    /**
     * @test
     */
    public function getSuccessfulStepMessageIsValidFormatAndDefaultMessage()
    {
        $message = $this->outputTitleHandler->getSuccessfulStepMessage();

        $this->assertEquals('<comment>Ok</comment>', $message);
    }
}
