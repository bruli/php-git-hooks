<?php

namespace PhpGitHooks\Application\Composer;

use Composer\IO\IOInterface;
use PhpGitHooks\Infrastructure\Config\ConfigFileReaderInterface;

final class ConfiguratorProcessor
{
    /**
     * @var IOInterface
     */
    private $IO;
    /**
     * @var ConfigFileReaderInterface
     */
    private $configFileReader;

    /**
     * ConfiguratorProcessor constructor.
     *
     * @param ConfigFileReaderInterface $configFileReader
     */
    public function __construct(ConfigFileReaderInterface $configFileReader)
    {
        $this->configFileReader = $configFileReader;
    }

    /**
     * @param IOInterface $IOInterface
     */
    public function setIO(IOInterface $IOInterface)
    {
        $this->IO = $IOInterface;
    }

    public function process()
    {
        var_dump($this->configFileReader->getFileContents());
        die;
    }
}
