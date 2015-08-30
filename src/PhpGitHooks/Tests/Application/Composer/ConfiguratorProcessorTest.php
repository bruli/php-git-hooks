<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Composer\IO\IOInterface;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Application\Composer\ConfiguratorProcessor;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileReaderInterface;
use PhpGitHooks\Infrastructure\Disk\Config\InMemoryConfigFileReader;
use PhpGitHooks\Infrastructure\Disk\Config\InMemoryConfigFileWriter;

final class ConfiguratorProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfiguratorProcessor
     */
    private $configuratorProcessor;
    /**
     * @var ConfigFileReaderInterface
     */
    private $configFileReader;
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var CommitMsgProcessor
     */
    private $commitMsgProcessor;
    /**
     * @var Mock
     */
    private $IO;

    protected function setUp()
    {
        $this->IO = \Mockery::mock(IOInterface::class);
        $this->configFileReader = new InMemoryConfigFileReader();
        $this->preCommitProcessor = new PreCommitProcessor();
        $this->preCommitProcessor->setIO($this->IO);
        $this->commitMsgProcessor = new CommitMsgProcessor();
        $this->commitMsgProcessor->setIO($this->IO);

        $this->configuratorProcessor = new ConfiguratorProcessor(
            $this->configFileReader,
            $this->preCommitProcessor,
            $this->commitMsgProcessor,
            new InMemoryConfigFileWriter()
        );
    }

    /**
     * @test
     */
    public function preCommitHookEnabled()
    {
        $this->IO->shouldReceive('ask')->andReturn('y');
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
            ->times(7)
            ->andReturn('y', 'n', 'y', 'y', 'y');

        $configData = $this->preCommitProcessor->execute([]);

        $execute = $configData['pre-commit']['execute'];

        $this->assertFalse($execute['phpunit']);
        $this->assertTrue($execute['phplint']);
        $this->assertTrue($execute['phpcs']);
        $this->assertTrue($execute['phpmd']);
    }

    /**
     * @test
     */
    public function preCommitConfigSimpleToolWithConfigData()
    {
        $this->IO->shouldReceive('ask')
            ->times(3)
            ->andReturn('y');

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
            ->twice()
            ->andReturn('y', 'psr2');

        $configData = $this->preCommitProcessor->execute(
            [
            'pre-commit' => [
                'execute' => [
                    'phpunit' => true,
                    'phpcs' => true,
                    'phplint' => true,
                    'phpmd' => true,
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
    public function commitMsgEnabledHook()
    {
        $this->IO->shouldReceive('ask')->twice()->andReturn('y');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertArrayHasKey('commit-msg', $commitMsg);
        $this->assertTrue($commitMsg['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function commitMsgDisabledHook()
    {
        $this->IO->shouldReceive('ask')->once()->andReturn('n');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertArrayHasKey('commit-msg', $commitMsg);
        $this->assertFalse($commitMsg['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function commitMsgExpressionRegular()
    {
        $this->IO->shouldReceive('ask')
            ->twice()
            ->andReturn('y', '#[0-9]{2,7}');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertSame('#[0-9]{2,7}', $commitMsg['commit-msg']['expression-regular']);
    }
}
