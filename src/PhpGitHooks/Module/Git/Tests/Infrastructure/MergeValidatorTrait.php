<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Model\MergeValidatorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait MergeValidatorTrait
{
    /**
     * @var MergeValidatorInterface
     */
    private $mergeValidator;

    /**
     * @return \Mockery\MockInterface|MergeValidatorInterface
     */
    protected function getMergeValidator()
    {
        return $this->mergeValidator = $this->mergeValidator ?: Mock::get(MergeValidatorInterface::class);
    }

    /**
     * @param bool $return
     */
    protected function shouldCallIsMerge($return)
    {
        $this->getMergeValidator()
            ->shouldReceive('isMerge')
            ->once()
            ->andReturn($return);
    }
}
