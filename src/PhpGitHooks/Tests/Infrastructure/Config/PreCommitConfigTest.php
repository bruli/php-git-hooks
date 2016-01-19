<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use PhpGitHooks\Application\Config\PreCommitConfig;
use PhpGitHooks\Infrastructure\Disk\Config\InMemoryConfigFileReader;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class PreCommitConfigTest.
 */
class PreCommitConfigTest extends \PHPUnit_Framework_TestCase
{
    const RIGHT_MESSAGE_KEY = 'right-message';
    const ERROR_MESSAGE_KEY = 'error-message';
    const RIGHT_MESSAGE = 'ok';
    const ERROR_MESSAGE = 'error';
    /** @var  PreCommitConfig */
    private $preCommitConfig;
    /** @var  InMemoryConfigFileReader */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileReader = new InMemoryConfigFileReader();
        $this->preCommitConfig = new PreCommitConfig($this->configFileReader);
    }

    /**
     * @test
     */
    public function invalidConfigData()
    {
        $data = [
            'pre-commit' => [
                'execute' => ['phpunit' => 'dfaa'],
            ],
        ];

        $this->configFileReader->fileContents = $data;

        $this->assertFalse($this->preCommitConfig->isEnabled('phpunit'));
    }

    /**
     * @test
     */
    public function serviceNameNotExists()
    {
        $data = [
            'pre-commit' => [
                'execute' => ['phpunit' => true],
            ],
        ];

        $this->configFileReader->fileContents = $data;

        $this->assertFalse($this->preCommitConfig->isEnabled('serviceName'));
    }

    /**
     * @test
     */
    public function serviceIsEnabled()
    {
        $data = [
            'pre-commit' => [
                'execute' => ['phpunit' => true],
            ],
        ];

        $this->configFileReader->fileContents = $data;

        $this->assertTrue($this->preCommitConfig->isEnabled('phpunit'));
    }

    /**
     * @test
     */
    public function noServiceDataThrowsException()
    {
        $this->setExpectedException(Exception::class);

        $this->configFileReader->fileContents = [];

        $this->preCommitConfig->isEnabled('phpunit');
    }

    /**
     * @test
     */
    public function getExtraOptions()
    {
        $this->configFileReader->fileContents = [
            'pre-commit' => [
                'execute' => [
                    'php-cs-fixer' => [
                        'enabled' => true,
                        'level' => 'psr0',
                    ],
                ],
            ],
        ];

        $this->preCommitConfig->extraOptions('php-cs-fixer');
    }

    /**
     * @test
     */
    public function getMessagesIsNotNull()
    {
        $this->configFileReader->fileContents = [
            'pre-commit' => [
                'message' => [
                        self::RIGHT_MESSAGE_KEY => self::RIGHT_MESSAGE,
                        self::ERROR_MESSAGE_KEY => self::ERROR_MESSAGE,
                    ],
            ],
        ];

        $messages = $this->preCommitConfig->getMessages();

        $this->assertArrayHasKey(self::RIGHT_MESSAGE_KEY, $messages);
        $this->assertArrayHasKey(self::ERROR_MESSAGE_KEY, $messages);
        $this->assertSame(self::RIGHT_MESSAGE, $messages[self::RIGHT_MESSAGE_KEY]);
        $this->assertSame(self::ERROR_MESSAGE, $messages[self::ERROR_MESSAGE_KEY]);
    }
}
