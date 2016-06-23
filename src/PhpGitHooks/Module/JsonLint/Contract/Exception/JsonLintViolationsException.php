<?php

namespace PhpGitHooks\Module\JsonLint\Contract\Exception;

class JsonLintViolationsException extends \Exception
{
    protected $message = 'There are invalid format in JSON file!';
}
