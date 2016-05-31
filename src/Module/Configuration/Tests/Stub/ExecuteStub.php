<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Composer;
use Module\Configuration\Domain\Execute;
use Module\Configuration\Domain\JsonLint;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpLint;
use Module\Configuration\Domain\PhpMd;
use Module\Configuration\Domain\PhpUnit;

class ExecuteStub
{
    /**
     * @param Composer   $composer
     * @param JsonLint   $jsonLint
     * @param PhpLint    $phpLint
     * @param PhpMd      $phpMd
     * @param PhpCs      $phpCs
     * @param PhpCsFixer $phpCsFixer
     * @param PhpUnit    $phpUnit
     *
     * @return Execute
     */
    public static function create(
        Composer $composer,
        JsonLint $jsonLint,
        PhpLint $phpLint,
        PhpMd $phpMd,
        PhpCs $phpCs,
        PhpCsFixer $phpCsFixer,
        PhpUnit $phpUnit
    ) {
        return new Execute([$composer, $jsonLint, $phpLint, $phpMd, $phpCs, $phpCsFixer, $phpUnit]);
    }
}
