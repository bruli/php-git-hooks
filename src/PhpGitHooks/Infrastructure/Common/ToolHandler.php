<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Command\OutputHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ToolHandler.
 */
abstract class ToolHandler
{
    const COMPOSER_VENDOR_DIR = '/../../../../../../';
    const COMPOSER_INSTALLED_FILE = 'composer/installed.json';

    /** @var OutputHandlerInterface  */
    protected $outputHandler;
    /** @var  OutputInterface */
    protected $output;

    /** @var array */
    private $tools = array(
        'phpcs' => 'squizlabs/php_codesniffer',
        'php-cs-fixer' => 'fabpot/php-cs-fixer',
        'phpmd' => 'phpmd/phpmd',
        'phpunit' => 'phpunit/phpunit',
        'phpunit-randomizer' => 'fiunchinho/phpunit-randomizer',
        'jsonlint' => 'seld/jsonlint',
    );
    /** @var array */
    private $installedPackages = array();

    /**
     * @param OutputHandlerInterface $outputHandler
     */
    public function __construct(OutputHandlerInterface $outputHandler)
    {
        $this->outputHandler = $outputHandler;

        $installedJson = dirname(__FILE__).self::COMPOSER_VENDOR_DIR.self::COMPOSER_INSTALLED_FILE;
        if (file_exists($installedJson)) { // else not installed over composer
            $packages = json_decode(file_get_contents($installedJson), true);
            foreach ($packages as $package) {
                $this->installedPackages[$package['name']] = $package;
            }
        }
    }

    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
        $this->output = $outputInterface;
    }

    /**
     * @param \Exception $exceptionClass
     * @param string     $errorText
     */
    protected function writeOutputError(\Exception $exceptionClass, $errorText)
    {
        $this->output->writeln(ErrorOutput::write($errorText));
        throw new $exceptionClass();
    }

    /**
     * @param string $tool
     *
     * @return string
     */
    protected function getBinPath($tool)
    {
        if (isset($this->installedPackages[$this->tools[$tool]])) {
            $package = $this->installedPackages[$this->tools[$tool]];
            foreach ($package['bin'] as $bin) {
                if (preg_match("#${tool}$#", $bin)) {
                    return dirname(__FILE__).self::COMPOSER_VENDOR_DIR.$package['name'].DIRECTORY_SEPARATOR.$bin;
                }
            }
        }

        return 'bin'.DIRECTORY_SEPARATOR.$tool;
    }
}
