<?php

namespace Module\PhpCsFixer\Contract\Exception;

class PhpCsFixerViolationsException extends \Exception
{
    protected $message = 'There are some PhpCsFixer styling errors!';
}
