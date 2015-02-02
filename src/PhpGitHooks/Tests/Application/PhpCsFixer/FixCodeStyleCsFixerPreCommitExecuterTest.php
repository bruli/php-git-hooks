<?php

namespace PhpGitHooks\Tests\Application\PhpCsFixer;

use PhpGitHooks\Application\PhpCsFixer\FixCodeStyleCsFixerPreCommitExecuter;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpCsFixer\InMemoryPhpCsFixerHandler;

/**
 * Class FixCodeStyleCsFixerPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpCsFixer
 */
class FixCodeStyleCsFixerPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FixCodeStyleCsFixerPreCommitExecuter */
    private $fixCodeStyleCsFixerPreCommitExecuter;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;
    /** @var  InMemoryPhpCsFixerHandler */
    private $phpCsFixerHandler;

    protected function setUp()
    {
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();
        $this->phpCsFixerHandler = new InMemoryPhpCsFixerHandler();
        $this->fixCodeStyleCsFixerPreCommitExecuter = new FixCodeStyleCsFixerPreCommitExecuter(
            $this->preCommitConfig,
            $this->phpCsFixerHandler
        );
    }

    /**
     * @test
     */
    public function idDisabled()
    {
        $this->preCommitConfig->setEnabled(false);
        $this->fixCodeStyleCsFixerPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }

    /**
     * @test
     */
    public function isEnabled()
    {
        $this->preCommitConfig->setEnabled(true);

        $this->fixCodeStyleCsFixerPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
