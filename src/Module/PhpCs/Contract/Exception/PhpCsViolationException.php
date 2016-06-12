<?php

namespace Module\PhpCs\Contract\Exception;

class PhpCsViolationException extends \Exception
{
    protected $message = 'There are PHPCS violations!';
}
