<?php

namespace PhpGitHooks\Module\Git\Infrastructure\OutputWriter;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\OutputInterface;

class ToolTittleOutputWriter
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * ToolTittleOutputWriter constructor.
     *
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param string $title
     */
    public function writeTitle($title)
    {
        $style = new OutputFormatterStyle('white', 'blue', ['bold', 'blink']);
        $this->output->getFormatter()->setStyle('custom', $style);
        $this->output->writeln(sprintf('<custom>%s</custom>', $title));
    }
}
