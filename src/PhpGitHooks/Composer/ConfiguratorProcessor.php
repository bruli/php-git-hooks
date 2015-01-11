<?php

namespace PhpGitHooks\Composer;

use Symfony\Component\Yaml\Yaml;

class ConfiguratorProcessor extends Processor
{
    const CONFIG_FILE = 'php-git-hooks.yml';
    private $configData = array();

    public function process()
    {
        $this->initConfigFile();
    }

    private function initConfigFile()
    {
        if (false === file_exists(self::CONFIG_FILE)) {
            $generate = $this->setQuestion('Do you want generate a php-git.hooks.yml file?', 'Y/n', 'Y');

            if ('N' === strtoupper($generate)) {
                $this->io->write(
                    '<error>Remember that you need a configuration file to use php-git-hooks library.</error>'
                );

                return;
            }

            $preCommit = new PreCommitProcessor($this->io);
            $this->configData = $preCommit->execute();

            $this->writeConfigFile();
        }
    }

    private function writeConfigFile()
    {
        $data = Yaml::dump($this->configData);

        file_put_contents(self::CONFIG_FILE, $data);
    }
}
