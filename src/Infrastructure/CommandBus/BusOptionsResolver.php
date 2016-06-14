<?php

namespace Infrastructure\CommandBus;

class BusOptionsResolver
{
    /**
     * @var array
     */
    private $commandOption = [];
    /**
     * @var array
     */
    private $queryOption = [];

    /**
     * @param string $command
     * @param string $handler
     */
    public function addCommandOption($command, $handler)
    {
        $this->commandOption[$command][] = $handler;
    }

    public function addQueryOption($query, $handler)
    {
        $this->queryOption[$query] = $handler;
    }

    /**
     * @param string $command
     *
     * @return array
     */
    public function getCommandOption($command)
    {
        return $this->commandOption[$command];
    }

    /**
     * @param string $query
     *
     * @return string
     */
    public function getQueryOption($query)
    {
        return $this->queryOption[$query];
    }
}
