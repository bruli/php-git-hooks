<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Composer\IO\IOInterface;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Infrastructure\Common\FileCopierInterface;
use PhpGitHooks\Infrastructure\Common\InMemoryFileCopier;
use PhpGitHooks\Infrastructure\Composer\InMemoryIOInterface;

/**
 * Class CommitMsgProcessorTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class CommitMsgProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;
    /** @var  FileCopierInterface */
    private $hooksFileCopier;
    /** @var  IOInterface */
    private $iOinterface;

    protected function setUp()
    {
        $this->hooksFileCopier = new InMemoryFileCopier();
        $this->iOinterface = new InMemoryIOInterface();

        $this->commitMsgProcessor = new CommitMsgProcessor($this->hooksFileCopier);
        $this->commitMsgProcessor->setIO($this->iOinterface);
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->iOinterface->setAsk('n');
        $data = $this->commitMsgProcessor->execute();

        $this->assertFalse($data['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function isEnabled()
    {
        $this->iOinterface->setAsk('y');
        $data = $this->commitMsgProcessor->execute();

        $this->assertTrue($data['commit-msg']['enabled']);
    }
}
