<?php

namespace PhpGitHooks\Module\Git\Service;

class PreCommitOutputWriter
{
    /**
     * @var string
     */
    private $message;

    /**
     * PreCommitOutputWriter constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        $maxLength = 50;
        $message = $this->message;
        $restLength = $maxLength - strlen($message);

        for ($i = 0; $restLength > $i; ++$i) {
            $message .= '.';
        }

        return sprintf('<info>%s</info>', $message);
    }

    /**
     * @return string
     */
    public function getSuccessfulMessage()
    {
        return '<comment>0K</comment>';
    }

    /**
     * @param string $error
     *
     * @return string
     */
    public function setError($error)
    {
        return sprintf('<error>%s</error>', trim($error));
    }

    public function getFailMessage()
    {
        return $this->setError('Fail');
    }
}
