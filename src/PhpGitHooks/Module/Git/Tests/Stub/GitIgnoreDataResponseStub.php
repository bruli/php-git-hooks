<?php

namespace PhpGitHooks\Module\Git\Tests\Stub;

use PhpGitHooks\Module\Git\Contract\Response\GitIgnoreDataResponse;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class GitIgnoreDataResponseStub implements RandomStubInterface
{
    /**
     * @param string $value
     *
     * @return GitIgnoreDataResponse
     */
    public static function create($value)
    {
        return new GitIgnoreDataResponse($value);
    }

    /**
     * @return GitIgnoreDataResponse
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->text());
    }

    /**
     * @return GitIgnoreDataResponse
     */
    public static function randomWithGuardCoverage()
    {
        $data = StubCreator::faker()->text()."\n".'.guard_coverage';

        return self::create($data);
    }
}
