<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\PhpMdOptions;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class PhpMdOptionsStub implements RandomStubInterface
{
    /**
     * @param string $value
     *
     * @return PhpMdOptions
     */
    public static function create($value)
    {
        return new PhpMdOptions($value);
    }

    /**
     * @return PhpMdOptions
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->word);
    }
}
