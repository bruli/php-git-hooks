<?php


namespace Module\Shared\Tests\Infrastructure;


use Infrastructure\QueryBus\QueryBus;
use Infrastructure\QueryBus\QueryInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait QueryBusTrait
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @return \Mockery\MockInterface|QueryBus
     */
    protected function getQueryBus()
    {
        return $this->queryBus = $this->queryBus ?: Mock::get(QueryBus::class);
    }

    /**
     * @param QueryInterface $query
     * @param mixed $return
     */
    protected function shouldHandleQuery(QueryInterface $query, $return)
    {
        $this->getQueryBus()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($query))
            ->andReturn($return);
    }
}