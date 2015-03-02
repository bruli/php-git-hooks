<?php

namespace PhpGitHooks\Command;

/**
 * Class OutputHandler.
 */
class OutputHandler implements OutputHandlerInterface
{
    const MAX_LENGTH = 50;
    const TITLE_SEPARATOR = '.';
    const SUCCESSFUL_MESSAGE = '0k';
    /** @var  string */
    private $title;
    /** @var  string */
    private $error;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        $text = $this->title;
        $length = $this->getlength();

        for ($i = 0; $i < $length; $i++) {
            $text .= self::TITLE_SEPARATOR;
        }

        return '<info>'.$text.'</info>';
    }

    /**
     * @return int
     */
    private function getlength()
    {
        return self::MAX_LENGTH - strlen($this->title);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return sprintf('<error>%s</error>', trim($this->error));
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @param null|string $message
     *
     * @return string
     */
    public function getSuccessfulStepMessage($message = null)
    {
        if (null === $message) {
            $message = self::SUCCESSFUL_MESSAGE;
        }

        return '<comment>'.$message.'</comment>';
    }
}
