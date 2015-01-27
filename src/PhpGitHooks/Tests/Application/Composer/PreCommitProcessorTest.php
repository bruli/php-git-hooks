<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Composer\IO\IOInterface;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\PreCommitProcessor;

/**
 * Class PreCommitProcessorTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class PreCommitProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitProcessor */
    private $preCommitProcessor;
    /** @var  Mock */
    private $hooksFileCopier;
    /** @var  Mock */
    private $IO;

    protected function setUp()
    {
        $this->IO = \Mockery::mock('Composer\IO\IOInterface');
        $this->hooksFileCopier = \Mockery::mock('PhpGitHooks\Infrastructure\Git\HooksFileCopier');
        $this->preCommitProcessor = new PreCommitProcessor($this->hooksFileCopier);
        $this->preCommitProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function userAlwaysSayNO()
    {
        $this->IO->shouldReceive('ask')
            ->times(6)
            ->andReturn('N', 'N', 'N', 'N', 'N', 'N');
        $data = $this->preCommitProcessor->execute();

        $this->assertFalse($data['pre-commit']['enabled']);
        $this->assertFalse($data['pre-commit']['execute']['phpunit']);
        $this->assertFalse($data['pre-commit']['execute']['phplint']);
        $this->assertFalse($data['pre-commit']['execute']['php-cs-fixer']);
        $this->assertFalse($data['pre-commit']['execute']['phpcs']);
        $this->assertFalse($data['pre-commit']['execute']['phpmd']);
    }

    /**
     * @test
     */
    public function userAlwaysSayYes()
    {
        $this->hooksFileCopier->shouldReceive('copy');

        $this->IO->shouldReceive('ask')
            ->times(6)
            ->andReturn('Y', 'Y', 'Y', 'Y', 'Y', 'Y');
        $data = $this->preCommitProcessor->execute();

        $this->assertTrue($data['pre-commit']['enabled']);
        $this->assertTrue($data['pre-commit']['execute']['phpunit']);
        $this->assertTrue($data['pre-commit']['execute']['phplint']);
        $this->assertTrue($data['pre-commit']['execute']['php-cs-fixer']);
        $this->assertTrue($data['pre-commit']['execute']['phpcs']);
        $this->assertTrue($data['pre-commit']['execute']['phpmd']);
    }
}
