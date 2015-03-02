<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\ComposerFilesValidator;
use PhpGitHooks\Command\InMemoryOutputHandler;
use PhpGitHooks\Command\OutputHandlerInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ComposerFilesValidatorTest.
 */
class ComposerFilesValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ComposerFilesValidator */
    private $composerFilesValidator;
    /** @var  OutputHandlerInterface */
    private $outputHandler;
    /** @var  OutputInterface */
    private $outuputInterface;

    protected function setUp()
    {
        $this->outputHandler = new InMemoryOutputHandler();
        $this->composerFilesValidator = new ComposerFilesValidator($this->outputHandler);
        $this->outuputInterface = new InMemoryOutputInterface();
    }

    /**
     * @test
     */
    public function validateReturnsException()
    {
        $this->setExpectedException('PhpGitHooks\Application\Composer\ComposerJsonNotCommitedException');

        $this->composerFilesValidator->setFiles(['composer.json']);
        $this->composerFilesValidator->setOutput($this->outuputInterface);
        $this->composerFilesValidator->validate();
    }

    /**
     * @test
     */
    public function validateSuccessfully()
    {
        $data = array(
            array('file1'),
            array('composer.json', 'composer.lock'),
        );

        foreach ($data as $files) {
            $this->composerFilesValidator->setOutput($this->outuputInterface);
            $this->composerFilesValidator->setFiles($files);

            $this->assertNull($this->composerFilesValidator->validate());
        }
    }
}
