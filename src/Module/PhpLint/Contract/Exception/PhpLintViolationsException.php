<?php

namespace Module\PhpLint\Contract\Exception;

class PhpLintViolationsException extends \Exception
{
    protected $message = 'There are some PHP syntax errors!.';
}
