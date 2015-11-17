<?php

namespace PhpGitHooks\Application\CodeCoverage;

use PhpGitHooks\Application\Config\PreCommitConfig;
use PhpGitHooks\Application\PhpUnit\PhpUnitHandler;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use PhpGitHooks\Infrastructure\PhpUnit\PhpUnitGenerateCloverFileProcessBuilder;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCodeCoveragePreCommitExecutor extends PreCommitExecutor
{

    protected $handler;
    protected $preCommitConfig;
    protected $cloverFileProcessor;

    /**
     * CheckCodeCoveragePreCommitExecutor constructor.
     * @param PhpUnitHandler $handler
     * @param PreCommitConfig $config
     * @param CloverFileProcessor $cloverFileProcessor
     */
    public function __construct(
        PhpUnitHandler $handler,
        PreCommitConfig $config,
        CloverFileProcessor $cloverFileProcessor
    )
    {
        $this->handler = $handler;
        $this->preCommitConfig = $config;
        $this->cloverFileProcessor = $cloverFileProcessor;
    }

    public function run(OutputInterface $output)
    {
        $data = $this->preCommitConfig->extraOptions($this->commandName());

        if (true === $data['enabled']) {
            $this->handler->setOutput($output);
            $this->handler->run();

            $currentPercentageCodeCoverage = $this->cloverFileProcessor
                ->calculateOverallCodeCoverage(PhpUnitGenerateCloverFileProcessBuilder::CLOVER_FILE);

            $atLeastExpectedCodeCoverage = $data['percentage'];
            if ($currentPercentageCodeCoverage < $atLeastExpectedCodeCoverage)
                throw new MinimunCodeCoverageNotOvercomeException(
                    sprintf(
                        'Expected code coverage should be at least %s right now %s',
                        $atLeastExpectedCodeCoverage,
                        $currentPercentageCodeCoverage
                    )
                );
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phpunit';
    }
}
