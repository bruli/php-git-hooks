<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Mockery\Mock;
use PhpGitHooks\Application\Composer\CheckComposerFilesPreCommitExecuter;

/**
 * Class CheckComposerFilesPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class CheckComposerFilesPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Mock */
    private $composerFilesValidator;
    /** @var  CheckComposerFilesPreCommitExecuter */
    private $checkComposerFilesPreCommitExecuter;
    /** @var  Mock */
    private $outputHandler;
    /** @var  Mock */
    private $outuputInterface;

    protected function setUp()
    {
        $this->outputHandler = \Mockery::mock('PhpGitHooks\Command\OutputHandler');
        $this->outuputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->composerFilesValidator = \Mockery::mock('PhpGitHooks\Application\Composer\ComposerFilesValidator');
        $this->checkComposerFilesPreCommitExecuter = new CheckComposerFilesPreCommitExecuter(
            $this->composerFilesValidator
        );
    }

    /**
     * @test
     */
    public function runSuccessful()
    {
        $this->composerFilesValidator->shouldReceive('setOutput');
        $this->composerFilesValidator->shouldReceive('setFiles');
        $this->composerFilesValidator->shouldReceive('validate');

        $this->checkComposerFilesPreCommitExecuter->run($this->outuputInterface, array());
    }
}
