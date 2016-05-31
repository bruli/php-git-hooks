<?php

namespace Module\Tests\Infrastructure\UnitTestCase;

use Faker\Factory;
use Mockery\Matcher\Closure;
use Mockery\MockInterface;
use ReflectionClass;

abstract class BaseUnitTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \Faker\Generator
     */
    protected function getFaker()
    {
        return Factory::create();
    }

    /**
     * @param mixed $class
     *
     * @return MockInterface
     */
    protected function mock($class)
    {
        return \Mockery::mock($class);
    }

    /**
     * @param mixed $class
     *
     * @return Closure
     */
    protected function similarTo($class)
    {
        $comparator = is_object($class) ? $this->getObjectComparator($class) : $this->getNumericComparator($class);

        return \Mockery::on($comparator);
    }

    /**
     * @param float $classA
     *
     * @return \Closure
     */
    private function getNumericComparator($classA)
    {
        return function ($classB) use ($classA) {
            return round($classA, 3) === round($classB, 3);
        };
    }

    /**
     * @param object $classA
     *
     * @return \Closure
     */
    private function getObjectComparator($classA)
    {
        return function ($classB) use ($classA) {

            $propertiesA = (new ReflectionClass($classA))->getProperties();
            $propertiesB = (new ReflectionClass($classB))->getProperties();

            return !(get_class($classA) !== get_class($classB)) || ($propertiesA != $propertiesB);
        };
    }

    /**
     * Returns given string without consecutive spaces or new lines.
     *
     * @param string $string
     *
     * @return string
     */
    protected function getStringWithoutWhitespaces($string)
    {
        return trim(preg_replace('/\s+/', ' ', $string));
    }
}
