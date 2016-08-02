<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerOptions;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class PhpCsFixerOptionsStub implements RandomStubInterface
{
    /**
     * @param string $value
     *
     * @return PhpCsFixerOptions
     */
    public static function create($value)
    {
        return new PhpCsFixerOptions($value);
    }

    /**
     * @return PhpCsFixerOptions
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->word);
    }
}
