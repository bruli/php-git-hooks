<?php


namespace Infraestructure\PhpUnit;

use PhpGitHooks\Infraestructure\PhpUnit\PhpUnitFileValidator;

/**
 * Class PhpUnitFileValidatorTest
 * @package Infraestructure\PhpUnit
 */
class PhpUnitFileValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function fileExistSuccessful()
    {
        $validator = new PhpUnitFileValidator();

        $this->assertTrue($validator->existsConfigFile());
    }
}
