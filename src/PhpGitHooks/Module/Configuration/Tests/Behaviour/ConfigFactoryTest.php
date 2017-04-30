<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\ConfigFactory;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigArrayDataStub;
use PHPUnit\Framework\TestCase;

class ConfigFactoryTest extends TestCase
{

    /**
     * @test
     */
    public function itShouldReturnEnabledConfig()
    {
        $data = ConfigArrayDataStub::hooksEnabledWithEnabledTools();

        $config = ConfigFactory::fromArray($data);

        $this->assertFalse($config->getPreCommit()->isUndefined());
        $this->assertTrue($config->getPreCommit()->isEnabled());
        $this->assertFalse($config->getCommitMsg()->isUndefined());
        $this->assertTrue($config->getCommitMsg()->isEnabled());
    }

    /**
     * @test
     */
    public function itShouldReturnUndefinedConfig()
    {
        $config = ConfigFactory::fromArray([]);

        $this->assertTrue($config->getPreCommit()->isUndefined());
        $this->assertFalse($config->getPreCommit()->isEnabled());
        $this->assertTrue($config->getCommitMsg()->isUndefined());
        $this->assertFalse($config->getCommitMsg()->isEnabled());
    }
}
