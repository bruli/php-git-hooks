<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\PhpCsFixer\InvalidPhpCsFixerConfigDataException;

final class PreCommitProcessor extends Processor
{
    private $simpleTools = ['phpunit', 'phpcs', 'jsonlint', 'phplint', 'phpmd'];

    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if (true === $this->enableHook($configData)) {
            $execute = $this->configData['pre-commit']['execute'];
            $this->configSimpleTools($execute);
            $this->configComplexTools($execute);
        }

        return $this->configData;
    }

    /**
     * @param array $configData
     *
     * @return bool
     */
    private function enableHook(array $configData)
    {
        if (!isset($configData['pre-commit'])) {
            $enable = $this->setQuestion('Do you want enable pre-commit hook?', '[Y/n]', 'Y');

            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData['pre-commit'] = [
                'enabled' => $enabled,
                'execute' => [],
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData['pre-commit']['enabled'];
    }

    /**
     * @param array $execute
     */
    private function configSimpleTools(array $execute)
    {
        foreach ($this->simpleTools as $tool) {
            if (!isset($execute[$tool])) {
                $answer = $this->setQuestionTool($tool);
                $this->configData['pre-commit']['execute'][$tool] = 'Y' === strtoupper($answer) ? true : false;
            }
        }
    }

    /**
     * @param array $execute
     */
    private function configComplexTools(array $execute)
    {
        $this->configPhpCsFixer($execute);
    }

    private function configPhpCsFixer($execute)
    {
        $tool = 'php-cs-fixer';

        if (!isset($execute[$tool])) {
            $answer = $this->setQuestionTool($tool);

            $this->configData['pre-commit']['execute'][$tool]['enabled'] = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $this->checkPhpCsFixerConfigData($execute[$tool]);
        }


        if (!isset($this->configData['pre-commit']['execute'][$tool]['levels'])) {
            foreach (['psr0', 'psr1', 'psr2', 'symfony'] as $level) {
                $answerLevel = strtolower($this->setQuestion(
                    sprintf('Enable %s level for %s tool', $level, strtoupper($tool)),
                    '[Y/n]',
                    'Y'
                ));

                $answerLevel = 'Y' === strtoupper($answerLevel) ? true : false;

                $this->configData['pre-commit']['execute'][$tool]['levels'][$level] = $answerLevel;
            }
        }
    }

    /**
     * @param string $tool
     *
     * @return string
     */
    private function setQuestionTool($tool)
    {
        return $this->setQuestion(sprintf('Do you want enable %s tool?', strtoupper($tool)), '[Y/n]', 'Y');
    }

    /**
     * @param array $configData
     *
     * @throws InvalidPhpCsFixerConfigDataException
     */
    private function checkPhpCsFixerConfigData($configData)
    {
        if (false === is_array($configData)) {
            throw new InvalidPhpCsFixerConfigDataException();
        }

        if (false === isset($configData['enabled'])) {
            throw new InvalidPhpCsFixerConfigDataException();
        }

        if (false === isset($configData['levels']) || false === is_array($configData['levels'])) {
            throw new InvalidPhpCsFixerConfigDataException();
        }
    }
}
