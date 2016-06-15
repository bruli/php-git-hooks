<?php

namespace Module\PhpUnit\Contract\Exception;

class PhpUnitViolationException extends \Exception
{
    protected $message = 'Fix your unit tests!';
}
