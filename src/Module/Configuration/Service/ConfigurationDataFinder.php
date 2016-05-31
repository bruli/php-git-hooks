<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Config;
use Module\Configuration\Model\ConfigurationFileReaderInterface;

class ConfigurationDataFinder
{
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configurationFileReader;

    /**
     * ConfigurationDataFinder constructor.
     *
     * @param ConfigurationFileReaderInterface $configurationFileReader
     */
    public function __construct(ConfigurationFileReaderInterface $configurationFileReader)
    {
        $this->configurationFileReader = $configurationFileReader;
    }

    /**
     * @return Config
     */
    public function find()
    {
        $data = $this->configurationFileReader->getData();

        return ConfigFactory::fromArray($data);
    }
}
