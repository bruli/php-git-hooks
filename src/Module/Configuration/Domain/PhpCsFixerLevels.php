<?php


namespace Module\Configuration\Domain;


class PhpCsFixerLevels
{
    /**
     * @var Level
     */
    private $psr0;
    /**
     * @var Level
     */
    private $psr1;
    /**
     * @var Level
     */
    private $psr2;
    /**
     * @var Level
     */
    private $symfony;

    /**
     * PhpCsFixerLevels constructor.
     * @param Level $psr0
     * @param Level $psr1
     * @param Level $psr2
     * @param Level $symfony
     */
    public function __construct(Level $psr0, Level $psr1, Level $psr2, Level $symfony)
    {
        $this->psr0 = $psr0;
        $this->psr1 = $psr1;
        $this->psr2 = $psr2;
        $this->symfony = $symfony;
    }

    /**
     * @return Level
     */
    public function getPsr0()
    {
        return $this->psr0;
    }

    /**
     * @return Level
     */
    public function getPsr1()
    {
        return $this->psr1;
    }

    /**
     * @return Level
     */
    public function getPsr2()
    {
        return $this->psr2;
    }

    /**
     * @return Level
     */
    public function getSymfony()
    {
        return $this->symfony;
    }
    
}