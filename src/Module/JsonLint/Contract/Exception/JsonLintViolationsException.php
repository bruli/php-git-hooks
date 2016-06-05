<?php

namespace Module\JsonLint\Contract\Exception;

class JsonLintViolationsException extends \Exception
{
    /**
     * JsonLintViolationsException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $msg = "There are JSONLINT violations!\n";
        parent::__construct(sprintf('%s %s', $msg, $message));
    }
}
