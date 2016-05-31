<?php

namespace Module\Tests\Infrastructure\Stub;

use Faker\Factory;
use Faker\Generator;

class StubCreator
{
    /**
     * @var Generator
     */
    private static $faker;
    /**
     * @return Generator
     */
    public static function faker()
    {
        return self::$faker = self::$faker ?: Factory::create();
    }
}
