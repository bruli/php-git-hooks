<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpMdResponse;

class PhpMdResponseStub
{
    const OPTIONS = '--minimumpriority 1';

    /**
     * @param bool        $phpMd
     * @param string|null $phpOptions
     *
     * @return PhpMdResponse
     */
    public static function create($phpMd, $phpOptions)
    {
        return new PhpMdResponse($phpMd, $phpOptions);
    }

    /**
     * @return PhpMdResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::OPTIONS);
    }
}
