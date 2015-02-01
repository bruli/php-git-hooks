<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Mockery\Mock;
use PhpGitHooks\Application\Composer\CheckComposerFilesPreCommitExecuter;
use PhpGitHooks\Application\Composer\InMemoryComposerFilesValidator;
use PhpGitHooks\Command\InMemoryOutputHandler;
use PhpGitHooks\Infrastructure\Common\InMemoryFilesValidator;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;

/**
 * Class CheckComposerFilesPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class CheckComposerFilesPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryFilesValidator */
    private $composerFilesValidator;
    /** @var  CheckComposerFilesPreCommitExecuter */
    private $checkComposerFilesPreCommitExecuter;
    /** @var  Mock */
    private $outputHandler;
    /** @var  Mock */
    private $outuputInterface;

    protected function setUp()
    {
        $this->outputHandler = new InMemoryOutputHandler();
        $this->outuputInterface = new InMemoryOutputInterface();
        $this->composerFilesValidator = new InMemoryComposerFilesValidator();
        $this->checkComposerFilesPreCommitExecuter = new CheckComposerFilesPreCommitExecuter(
            $this->composerFilesValidator
        );
    }

    /**
     * @test
     */
    public function runSuccessful()
    {
        $this->checkComposerFilesPreCommitExecuter->run($this->outuputInterface, array());
    }
}
