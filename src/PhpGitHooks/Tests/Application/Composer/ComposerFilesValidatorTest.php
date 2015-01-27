<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Mockery\Mock;
use PhpGitHooks\Application\Composer\ComposerFilesValidator;

/**
 * Class ComposerFilesValidatorTest
 * @package PhpGitHooks\Tests\Infrastructure\Composer
 */
class ComposerFilesValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ComposerFilesValidator */
    private $composerFilesValidator;
    /** @var  Mock */
    private $outputHandler;
    /** @var  Mock */
    private $outuputInterface;

    protected function setUp()
    {
        $this->outputHandler = \Mockery::mock('PhpGitHooks\Command\OutputHandler');
        $this->composerFilesValidator = new ComposerFilesValidator($this->outputHandler);
        $this->outuputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

        $this->outputHandler->shouldReceive('setTitle');
        $this->outputHandler->shouldReceive('getTitle');
        $this->outputHandler->shouldReceive('getSuccessfulStepMessage');
        $this->outuputInterface->shouldReceive('write');
        $this->outuputInterface->shouldReceive('writeln');
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
