<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Exception;

class InvalidStrictCoverageException extends \Exception
{
    /**
     * InvalidStrictCoverageException constructor.
     *
     * @param string $currentValue
     * @param float  $minimum
     */
    public function __construct($currentValue, $minimum)
    {
        parent::__construct(sprintf('Your current coverage %s is lower than %s', $currentValue, $minimum));
    }
}
