<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Git\Contract\Query\GitIgnoreExtractor;
use PhpGitHooks\Module\Git\Contract\Query\GitIgnoreExtractorHandler;
use PhpGitHooks\Module\Git\Contract\Response\GitIgnoreDataResponse;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;

class GitIgnoreExtractorHandlerTest extends GitUnitTestCase
{
    /**
     * @var GitIgnoreExtractorHandler
     */
    private $gitIgnoreExtractorQueryHandler;

    protected function setUp(): void
    {
        $this->gitIgnoreExtractorQueryHandler = new GitIgnoreExtractorHandler($this->getGitIgnoreFileReader());
    }

    /**
     * @test
     */
    public function itShouldReturnNotNull()
    {
        $content = 'composer.phar
        vendor/
        bin/
        php-git-hooks.yml
        # Commit your application\'s lock file http://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file
        # You may choose to ignore a library lock file http://getcomposer.org/doc/02-libraries.md#lock-file
        # composer.lock
        ';

        $this->shouldReadGitIgnoreFile($content);

        $query = new GitIgnoreExtractor();

        $data = $this->gitIgnoreExtractorQueryHandler->handle($query);

        $this->assertInstanceOf(GitIgnoreDataResponse::class, $data);
        $this->assertNotNull($data->getContent());
    }
}
