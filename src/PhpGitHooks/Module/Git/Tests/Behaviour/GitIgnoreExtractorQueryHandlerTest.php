<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Git\Contract\Query\GitIgnoreExtractorQuery;
use PhpGitHooks\Module\Git\Contract\QueryHandler\GitIgnoreExtractorQueryHandler;
use PhpGitHooks\Module\Git\Service\GitIgnoreExtractor;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;

class GitIgnoreExtractorQueryHandlerTest extends GitUnitTestCase
{
    /**
     * @var GitIgnoreExtractorQueryHandler
     */
    private $gitIgnoreExtractorQueryHandler;

    protected function setUp()
    {
        $this->gitIgnoreExtractorQueryHandler = new GitIgnoreExtractorQueryHandler(
            new GitIgnoreExtractor($this->getGitIgnoreFileReader())
        );
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

        $query = new GitIgnoreExtractorQuery();

        $data = $this->gitIgnoreExtractorQueryHandler->handle($query);

        $this->assertNotNull($data);
    }
}
