<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Execute;

class PrePushExecuteFactory
{
    /**
     * @param array $data
     *
     * @return Execute
     */
    public static function fromArray(array $data)
    {
        $tools = [
            isset($data['phpunit']) ? PhpUnitFactory::fromArray($data['phpunit']) : PhpUnitFactory::setUndefined(),
            isset($data['phpunit']['strict-coverage']) ? PhpUnitStrictCoverageFactory::fromArray(
                $data['phpunit']['strict-coverage']
            ) : PhpUnitStrictCoverageFactory::setUndefined()
        ];

        return new Execute($tools);
    }

    /**
     * @return Execute
     */
    public static function setUndefined()
    {
        return new Execute(
            [
                PhpUnitFactory::setUndefined(),
                PhpUnitStrictCoverageFactory::setUndefined()
            ]
        );
    }
}
