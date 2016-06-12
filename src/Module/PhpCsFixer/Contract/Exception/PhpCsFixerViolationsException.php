<?php

namespace Module\PhpCsFixer\Contract\Exception;

class PhpCsFixerViolationsException extends \Exception
{
    protected $message = 'Php-cs-fixer violations.';
}
