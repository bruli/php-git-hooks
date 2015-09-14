<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Composer\IO\IOInterface;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Application\PhpCsFixer\InvalidPhpCsFixerConfigDataException;

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
            ->times(12)
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
            ->times(12)
            ->andReturn('y', 'n', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y');

        $configData = $this->preCommitProcessor->execute([]);

        $execute = $configData['pre-commit']['execute'];

        $this->assertArrayHasKey('enabled', $execute['phpunit']);
        $this->assertArrayHasKey('random-mode', $execute['phpunit']);
        $this->assertTrue($execute['phplint']);
        $this->assertFalse($execute['phpcs']);
        $this->assertTrue($execute['phpmd']);
        $this->assertTrue($execute['jsonlint']);
    }

    /**
     * @test
     */
    public function preCommitConfigSimpleToolWithConfigData()
    {
        $this->IO->shouldReceive('ask')
            ->times(7)
            ->andReturn('y');

        $configData = $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => [
                            'enabled' => true,
                            'random-mode' => true
                        ],
                        'phpcs' => true,
                        'phplint' => true,
                    ],
                    'enabled' => true,
                ],
            ]
        );

        $execute = $configData['pre-commit']['execute'];

        $this->assertTrue($execute['phpunit']['enabled']);
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
            ->times(5)
            ->andReturn('y');

        $configData = $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => [
                            'enabled' => true,
                            'random-mode' => true
                        ],
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

        $fixer = $execute['php-cs-fixer'];
        $this->assertTrue($fixer['enabled']);
        $this->assertArrayHasKey('levels', $fixer);

        $levels = $fixer['levels'];
        $this->assertTrue($levels['psr0']);
        $this->assertTrue($levels['psr1']);
        $this->assertTrue($levels['psr2']);
        $this->assertTrue($levels['symfony']);
    }

    /**
     * @test
     */
    public function phpCsFixerConfigDataHasInvalidEntry()
    {
        $this->setExpectedException(InvalidPhpCsFixerConfigDataException::class);
        $this->IO->shouldReceive('ask');

        $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => true,
                        'phpcs' => true,
                        'phplint' => true,
                        'phpmd' => true,
                        'jsonlint' => true,
                        'php-cs-fixer' => true
                    ],
                    'enabled' => true,
                ],
            ]
        );
    }

    /**
     * @test
     */
    public function phpCsFixerConfigDataHasInvalidEntryEnabled()
    {
        $this->setExpectedException(InvalidPhpCsFixerConfigDataException::class);
        $this->IO->shouldReceive('ask');

        $this->preCommitProcessor->execute(
            [
                'pre-commit' => [
                    'execute' => [
                        'phpunit' => true,
                        'phpcs' => true,
                        'phplint' => true,
                        'phpmd' => true,
                        'jsonlint' => true,
                        'php-cs-fixer' => []
                    ],
                    'enabled' => true,
                ],
            ]
        );
    }
}
