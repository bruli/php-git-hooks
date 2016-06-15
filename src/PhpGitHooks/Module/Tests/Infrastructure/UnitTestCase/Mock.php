<?php

namespace PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase;

class Mock
{
    /**
     * @param mixed $class
     *
     * @return \Mockery\MockInterface
     */
    public static function get($class)
    {
        return \Mockery::mock($class);
    }
}
