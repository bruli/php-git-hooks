<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\PhpUnitOptions;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class PhpUnitOptionsStub implements RandomStubInterface
{
    /**
     * @param string|null $value
     *
     * @return PhpUnitOptions
     */
    public static function create($value)
    {
        return new PhpUnitOptions($value);
    }

    /**
     * @return PhpUnitOptions
     */
    public static function random()
    {
        $generator = StubCreator::faker();
        $options = [null, $generator->word, $generator->word];

        return self::create($options[array_rand($options)]);
    }
}
