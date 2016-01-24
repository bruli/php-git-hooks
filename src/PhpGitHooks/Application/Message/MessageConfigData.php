<?php

namespace PhpGitHooks\Application\Message;

use Composer\IO\IOInterface;

class MessageConfigData
{
    const TOOL = 'message';
    const DEFAULT_RIGHT_MESSAGE = 'HEY, GOOD JOB!!';
    const DEFAULT_ERROR_MESSAGE = 'FIX YOUR FUCKING CODE!!';
    const KEY_RIGHT_MESSAGE = 'right-message';
    const KEY_ERROR_MESSAGE = 'error-message';
    /**
     * @var array
     */
    private $configData;
    /**
     * @var IOInterface
     */
    private $io;
    /**
     * @var string
     */
    private $hook;

    /**
     * MessageConfigData constructor.
     *
     * @param IOInterface $io
     * @param $hook
     */
    public function __construct(IOInterface $io, $hook)
    {
        $this->io = $io;
        $this->hook = $hook;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function config(array $data)
    {
        $this->configData = $data;
        $this->configMessages();

        return $this->configData[self::TOOL];
    }

    private function configMessages()
    {
        if (!isset($this->configData[self::TOOL])) {
            $this->configData = [];
            $rightMessage = $this->setMessage(
                sprintf('Write a right message for %s hook:', $this->hook),
                self::DEFAULT_RIGHT_MESSAGE
            );
            $errorMessage = $this->setMessage(
                sprintf('Write a error message for %s hook:', $this->hook),
                self::DEFAULT_ERROR_MESSAGE
            );

            $this->configData[self::TOOL][self::KEY_RIGHT_MESSAGE] = $rightMessage;
            $this->configData[self::TOOL][self::KEY_ERROR_MESSAGE] = $errorMessage;
        }
    }

    /**
     * @param string $message
     * @param string $default
     *
     * @return string
     */
    private function setMessage($message, $default)
    {
        return strtoupper($this->io
            ->ask(sprintf('<info>%s</info> [<comment>%s</comment>]', $message, $default), $default));
    }
}
