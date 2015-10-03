<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\CheckComposerFilesPreCommitExecutor;
use PhpGitHooks\Application\Composer\ComposerFilesValidator;
use PhpGitHooks\Command\InMemoryOutputHandler;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\Common\InMemoryFilesValidator;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;

class CheckComposerFilesPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryFilesValidator */
    private $composerFilesValidator;
    /** @var  CheckComposerFilesPreCommitExecutor */
    private $checkComposerFilesPreCommitExecutor;
    /** @var  InMemoryOutputHandler */
    private $outputHandler;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;

    protected function setUp()
    {
        $this->outputHandler = new InMemoryOutputHandler();
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();
    }

    /**
     * @test
     */
    public function runSuccessful()
    {
        $this->preCommitConfig->setEnabled(true);

        $this->composerFilesValidator = $this->getMockBuilder(ComposerFilesValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->composerFilesValidator
            ->expects($this->once())
            ->method('validate');

        $this->checkComposerFilesPreCommitExecutor = new CheckComposerFilesPreCommitExecutor(
            $this->preCommitConfig,
            $this->composerFilesValidator
        );

        $this->checkComposerFilesPreCommitExecutor->run($this->outputInterface, array());
    }

    /**
     * @test
     */
    public function toolIsDisabled()
    {
        $this->preCommitConfig->setEnabled(false);

        $this->composerFilesValidator = $this->getMockBuilder(ComposerFilesValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->composerFilesValidator
            ->expects($this->never())
            ->method('validate');

        $this->checkComposerFilesPreCommitExecutor = new CheckComposerFilesPreCommitExecutor(
            $this->preCommitConfig,
            $this->composerFilesValidator
        );

        $this->checkComposerFilesPreCommitExecutor->run($this->outputInterface, array());
    }
}
