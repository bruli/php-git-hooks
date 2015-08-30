<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileReaderInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class PreCommitConfig.
 */
class PreCommitConfig implements HookConfigInterface, HookConfigExtraToolInterface
{
    /** @var  ConfigFileReaderInterface */
    private $configFileReader;

    /**
     * PreCommitConfig constructor.
     *
     * @param ConfigFileReaderInterface $configFileReader
     */
    public function __construct(ConfigFileReaderInterface $configFileReader)
    {
        $this->configFileReader = $configFileReader;
    }

    /**
     * @param $service
     *
     * @return bool
     */
    public function isEnabled($service)
    {
        $data = $this->getData();

        if (false === isset($data[$service]) || false === is_bool($data[$service])) {
            return false;
        }

        return $data[$service];
    }

    /**
     * @return array
     */
    private function getData()
    {
        $data = $this->configFileReader->getFileContents();

        if (!$data) {
            throw new Exception('php-git-hooks.yml file not found');
        }

        return $data['pre-commit']['execute'];
    }

    /**
     * @param array $tool
     *
     * @return array
     */
    public function extraOptions($tool)
    {
        $data = $this->getData();

        return $data[$tool];
    }
}
