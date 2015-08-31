<?php

namespace PhpGitHooks\Infrastructure\JsonLint;

final class JsonLintViolationsException extends \Exception
{
    protected $message = "There are JSONLINT violations!\n";

    public function __construct($message)
    {
        $this->message .= $message;
    }
}
