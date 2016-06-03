<?php

namespace Module\Tests\Infrastructure\UnitTestCase;

use ReflectionClass;

class SimilarTo
{
    /**
     * @param $class
     *
     * @return \Mockery\Matcher\Closure
     */
    public function compare($class)
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
}
