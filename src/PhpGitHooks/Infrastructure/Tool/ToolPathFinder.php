<?php

namespace PhpGitHooks\Infrastructure\Tool;

class ToolPathFinder
{
    const COMPOSER_VENDOR_DIR = '/../../../';
    const COMPOSER_INSTALLED_FILE = 'composer/installed.json';

    /** @var array */
    private $tools = array(
        'phpcs' => 'squizlabs/php_codesniffer',
        'php-cs-fixer' => 'friendsofphp/php-cs-fixer',
        'phpmd' => 'phpmd/phpmd',
        'phpunit' => 'phpunit/phpunit',
        'phpunit-randomizer' => 'fiunchinho/phpunit-randomizer',
        'jsonlint' => 'seld/jsonlint',
    );
    /** @var array */
    private $installedPackages = array();

    /**
     * @param string $tool
     *
     * @return string
     */
    public function find($tool)
    {
        if (isset($this->installedPackages[$this->tools[$tool]])) {
            $package = $this->installedPackages[$this->tools[$tool]];
            foreach ($package['bin'] as $bin) {
                if (preg_match("#${tool}$#", $bin)) {
                    return __DIR__.self::COMPOSER_VENDOR_DIR.$package['name'].DIRECTORY_SEPARATOR.$bin;
                }
            }
        }

        $binToolPath = 'bin'.DIRECTORY_SEPARATOR.$tool;
        if (file_exists($binToolPath) && is_file($binToolPath)) {
            return $binToolPath;
        }

        return 'vendor'.DIRECTORY_SEPARATOR.$binToolPath;
    }
}
