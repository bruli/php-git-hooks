<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Infrastructure\Common\InMemoryFileCopier;
use PhpGitHooks\Infrastructure\Composer\InMemoryIOInterface;

/**
 * Class PreCommitProcessorTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class PreCommitProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitProcessor */
    private $preCommitProcessor;
    /** @var  InMemoryFileCopier */
    private $hooksFileCopier;
    /** @var  InMemoryIOInterface */
    private $IO;

    protected function setUp()
    {
        $this->IO = new InMemoryIOInterface();
        $this->hooksFileCopier = new InMemoryFileCopier();
        $this->preCommitProcessor = new PreCommitProcessor($this->hooksFileCopier);
        $this->preCommitProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function userAlwaysSayNO()
    {
        $this->IO->setAsk('n');
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
        $this->IO->setAsk('y');
        $data = $this->preCommitProcessor->execute();

        $this->assertTrue($data['pre-commit']['enabled']);
        $this->assertTrue($data['pre-commit']['execute']['phpunit']);
        $this->assertTrue($data['pre-commit']['execute']['phplint']);
        $this->assertTrue($data['pre-commit']['execute']['php-cs-fixer']);
        $this->assertTrue($data['pre-commit']['execute']['phpcs']);
        $this->assertTrue($data['pre-commit']['execute']['phpmd']);
    }
}
