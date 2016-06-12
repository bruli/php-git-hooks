<?php

namespace Module\JsonLint\Contract\Exception;

class JsonLintViolationsException extends \Exception
{
    protected $message = 'There are JSONLINT violations!';
}
