<?php

namespace Infrastructure\CommandBus;

class BusOptionsResolver
{
    /**
     * @var array
     */
    private $option = [];

    /**
     * @param string $command
     * @param string $handler
     */
    public function addOption($command, $handler)
    {
        $this->option[$command][] = $handler;
    }

    /**
     * @param string $command
     *
     * @return array
     */
    public function getOption($command)
    {
        return $this->option[$command];
    }
}
