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
        $data = ['pre-commit' => ['execute' => ['phpunit' => 'dfaa'],
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
        $data = ['pre-commit' => ['execute' => ['phpunit' => true],
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
        $data = ['pre-commit' => ['execute' => ['phpunit' => true],
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
        $this->configFileReader->fileContents = ['pre-commit' => ['execute' => ['php-cs-fixer' => [
                'enabled' => true,
                'level' => 'psr0',
            ]]]];

        $this->preCommitConfig->extraOptions('php-cs-fixer');
    }
}
