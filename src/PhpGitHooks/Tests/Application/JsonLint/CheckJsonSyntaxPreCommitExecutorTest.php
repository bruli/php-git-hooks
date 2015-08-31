<?php

namespace PhpGitHooks\Tests\Application\JsonLint;

use PhpGitHooks\Application\JsonLint\CheckJsonSyntaxPreCommitExecutor;
use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\JsonLint\InMemoryJsonLintHandler;
use Symfony\Component\Console\Output\OutputInterface;

class CheckJsonSyntaxPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckJsonSyntaxPreCommitExecutor */
    private $checkJsonSyntaxPreCommitExecutor;
    /** @var  RecursiveToolInterface */
    private $jsonLintHandler;
    /** @var  InMemoryHookConfig */
    private $hookConfig;
    /** @var  OutputInterface */
    public $output;

    protected function setUp()
    {
        $this->jsonLintHandler = new InMemoryJsonLintHandler();
        $this->hookConfig = new InMemoryHookConfig();
        $this->output = new InMemoryOutputInterface();
        $this->checkJsonSyntaxPreCommitExecutor = new CheckJsonSyntaxPreCommitExecutor(
            $this->jsonLintHandler,
            $this->hookConfig
        );
    }

    /**
     * @test
     */
    public function isEnabled()
    {
        $this->hookConfig->setEnabled(true);

        $this->checkJsonSyntaxPreCommitExecutor->run($this->output, [], 'needle');
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->hookConfig->setEnabled(false);
        $this->checkJsonSyntaxPreCommitExecutor->run($this->output, [], 'needle');
    }
}
