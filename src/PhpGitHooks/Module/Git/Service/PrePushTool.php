<?php

namespace PhpGitHooks\Module\Git\Service;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandBus;
use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryBus;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Git\Contract\Exception\InvalidPushException;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Model\PrePushOriginalExecutorInterface;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;
use Symfony\Component\Console\Output\OutputInterface;

class PrePushTool
{
    const PRE_PUSH_HOOK = '<comment>Pre-push hook</comment>';
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * @var PrePushOriginalExecutorInterface
     */
    private $prePushOriginalExecutor;
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * PrePushTool constructor.
     *
     * @param QueryBus                         $queryBus
     * @param PrePushOriginalExecutorInterface $prePushOriginalExecutor
     * @param OutputInterface                  $output
     * @param CommandBus                       $commandBus
     */
    public function __construct(
        QueryBus $queryBus,
        PrePushOriginalExecutorInterface $prePushOriginalExecutor,
        OutputInterface $output,
        CommandBus $commandBus
    ) {
        $this->queryBus = $queryBus;
        $this->prePushOriginalExecutor = $prePushOriginalExecutor;
        $this->output = $output;
        $this->commandBus = $commandBus;
    }

    /**
     * @param string $remote
     * @param string $url
     *
     * @throws InvalidPushException
     */
    public function execute($remote, $url)
    {
        /** @var ConfigurationDataResponse $configurationData */
        $configurationData = $this->queryBus->handle(new ConfigurationDataFinderQuery());
        $prePushResponse = $configurationData->getPrePush();

        if (true === $prePushResponse->isPrePush()) {
            $this->output->writeln(self::PRE_PUSH_HOOK);
            $this->executeOriginalHook($remote, $url, $prePushResponse->getErrorMessage());

            $phpunitResponse = $prePushResponse->getPhpUnit();

            if (true === $phpunitResponse->isPhpunit()) {
                $this->commandBus->handle(
                    new PhpUnitToolCommand(
                        $phpunitResponse->isPhpunitRandomMode(),
                        $phpunitResponse->getPhpunitOptions(),
                        $prePushResponse->getErrorMessage()
                    )
                );

                $phpunitStrictCoverageResponse = $prePushResponse->getPhpUnitStrictCoverage();

                if (true === $phpunitStrictCoverageResponse->isPhpunitStrictCoverage()) {
                    $this->commandBus->handle(
                        new StrictCoverageCommand(
                            $phpunitStrictCoverageResponse->getMinimum(),
                            $prePushResponse->getErrorMessage()
                        )
                    );
                }

                $phpunitGuardCoverageResponse = $prePushResponse->getPhpUnitGuardCoverage();

                if (true === $phpunitGuardCoverageResponse->isEnabled()) {
                    $this->commandBus->handle(
                        new GuardCoverageCommand($phpunitGuardCoverageResponse->getWarningMessage())
                    );
                }
            }

            $this->output->writeln(GoodJobLogoResponse::paint($prePushResponse->getRightMessage()));
        }
    }

    /**
     * @param string $remote
     * @param string $url
     * @param string $errorMessage
     *
     * @throws InvalidPushException
     */
    private function executeOriginalHook($remote, $url, $errorMessage)
    {
        $response = $this->prePushOriginalExecutor->execute($remote, $url);

        if (null != $response) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new InvalidPushException();
        }
    }
}
