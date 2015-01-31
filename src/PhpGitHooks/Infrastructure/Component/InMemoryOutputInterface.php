<?php

namespace PhpGitHooks\Infrastructure\Component;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InMemoryOutputInterface implements OutputInterface
{
    /**
     * Writes a message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline
     * @param int          $type     The type of output (one of the OUTPUT constants)
     *
     * @throws \InvalidArgumentException When unknown output type is given
     *
     * @api
     */
    public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL)
    {
        // TODO: Implement write() method.
    }

    /**
     * Writes a message to the output and adds a newline at the end.
     *
     * @param string|array $messages The message as an array of lines of a single string
     * @param int          $type     The type of output (one of the OUTPUT constants)
     *
     * @throws \InvalidArgumentException When unknown output type is given
     *
     * @api
     */
    public function writeln($messages, $type = self::OUTPUT_NORMAL)
    {
        // TODO: Implement writeln() method.
    }

    /**
     * Sets the verbosity of the output.
     *
     * @param int $level The level of verbosity (one of the VERBOSITY constants)
     *
     * @api
     */
    public function setVerbosity($level)
    {
        // TODO: Implement setVerbosity() method.
    }

    /**
     * Gets the current verbosity of the output.
     *
     * @return int The current level of verbosity (one of the VERBOSITY constants)
     *
     * @api
     */
    public function getVerbosity()
    {
        // TODO: Implement getVerbosity() method.
    }

    /**
     * Sets the decorated flag.
     *
     * @param bool $decorated Whether to decorate the messages
     *
     * @api
     */
    public function setDecorated($decorated)
    {
        // TODO: Implement setDecorated() method.
    }

    /**
     * Gets the decorated flag.
     *
     * @return bool true if the output will decorate messages, false otherwise
     *
     * @api
     */
    public function isDecorated()
    {
        // TODO: Implement isDecorated() method.
    }

    /**
     * Sets output formatter.
     *
     * @param OutputFormatterInterface $formatter
     *
     * @api
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        // TODO: Implement setFormatter() method.
    }

    /**
     * Returns current output formatter instance.
     *
     * @return OutputFormatterInterface
     *
     * @api
     */
    public function getFormatter()
    {
        // TODO: Implement getFormatter() method.
    }
}
