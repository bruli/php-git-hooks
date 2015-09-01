<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Composer\IO\IOInterface;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\PreCommitProcessor;

class PreCommitProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitProcessor */
    private $preCommitProcessor;
    /** @var  Mock */
    private $IO;

    protected function setUp()
    {
        $this->IO = \Mockery::mock(IOInterface::class);
        $this->preCommitProcessor = new PreCommitProcessor();
        $this->preCommitProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function preCommitHookEnabled()
    {
        $this->IO->shouldReceive('ask')
            ->times(8)
            ->andReturn('y', 'y', 'y', 'y', 'y', 'y', 'y', 'psr0');
        $configData = $this->preCommitProcessor->execute([]);

        $this->assertTrue($configData['pre-commit']['enabled']);
    }

    /**
     * @test
     */
    public function preCommitHookDisabled()
    {
        $this->IO->shouldReceive('ask')->andReturn('n');
        $configData = $this->preCommitProcessor->execute([]);

        $preCommit = $configData['pre-commit'];
        $this->assertFalse($preCommit['enabled']);
        $this->assertArrayHasKey('execute', $preCommit);
    }

    /**
     * @test
     */
    public function preCommitConfigNewSimpleToolWithoutConfigData()
    {
        $this->IO->shouldReceive('ask')
            ->times(8)
            ->andReturn('y', 'n', 'y', 'y', 'y', 'y', 'y', 'PSR1');

        $configData = $this->preCommitProcessor->execute([]);

        $execute = $configData['pre-commit']['execute'];

        $this->assertFalse($execute['phpunit']);
        $this->assertTrue($execute['phplint']);
        $this->assertTrue($execute['phpcs']);
        $this->assertTrue($execute['phpmd']);
        $this->assertTrue($execute['jsonlint']);
    }

    /**
     * @test
     */
    public function preCommitConfigSimpleToolWithConfigData()
    {
        $this->IO->shouldReceive('ask')
            ->times(4)
            ->andReturn('y', 'y', 'y', 'symfony');

        $configData = $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => true,
                        'phpcs' => true,
                        'phplint' => true,
                    ],
                    'enabled' => true,
                ],
            ]
        );

        $execute = $configData['pre-commit']['execute'];

        $this->assertTrue($execute['phpunit']);
        $this->assertTrue($execute['phplint']);
        $this->assertTrue($execute['phpcs']);
        $this->assertTrue($execute['phpmd']);
    }

    /**
     * @test
     */
    public function preCommitAddPhpCsFixer()
    {
        $this->IO->shouldReceive('ask')
            ->times(2)
            ->andReturn('y', 'psr2');

        $configData = $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => true,
                        'phpcs' => true,
                        'phplint' => true,
                        'phpmd' => true,
                        'jsonlint' => true
                    ],
                    'enabled' => true,
                ],
            ]
        );

        $execute = $configData['pre-commit']['execute'];

        $this->assertArrayHasKey('php-cs-fixer', $execute);
        $this->assertTrue($execute['php-cs-fixer']['enabled']);
        $this->assertEquals('psr2', $execute['php-cs-fixer']['level']);
    }

    /**
     * @test
     */
    public function preCommitAddPhpCsFixerWithInvalidLevel()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->IO->shouldReceive('ask')
            ->times(2)
            ->andReturn('y', 'invalid_level');

        $configData = $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => true,
                        'phpcs' => true,
                        'phplint' => true,
                        'phpmd' => true,
                        'jsonlint' => true
                    ],
                    'enabled' => true,
                ],
            ]
        );

        $configData['pre-commit']['execute'];
    }
}
