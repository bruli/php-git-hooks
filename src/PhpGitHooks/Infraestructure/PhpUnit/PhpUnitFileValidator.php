<?php


namespace PhpGitHooks\Infraestructure\PhpUnit;

/**
 * Class PhpUnitFileValidator
 * @package PhpGitHooks\Infraestructure\PhpUnit
 */
class PhpUnitFileValidator 
{
    /**
     * @return bool
     */
    public function existsConfigFile()
    {
        return (file_exists('phpunit.xml.dist') || file_exists('phpunit.xml'));
    }
}