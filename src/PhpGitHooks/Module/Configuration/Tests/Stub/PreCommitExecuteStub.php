<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Composer;
use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\JsonLint;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpLint;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;

class PreCommitExecuteStub
{
    /**
     * @param Composer              $composer
     * @param JsonLint              $jsonLint
     * @param PhpLint               $phpLint
     * @param PhpMd                 $phpMd
     * @param PhpCs                 $phpCs
     * @param PhpCsFixer            $phpCsFixer
     * @param PhpUnit               $phpUnit
     * @param PhpUnitStrictCoverage $strictCoverage
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
        PhpUnit $phpUnit,
        PhpUnitStrictCoverage $strictCoverage
    ) {
        return new Execute([$composer, $jsonLint, $phpLint, $phpMd, $phpCs, $phpCsFixer, $phpUnit, $strictCoverage]);
    }
}
