<?php

namespace PhpGitHooks\Module\Git\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandBus;
use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Bruli\EventBusBundle\QueryBus\QueryBus;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Git\Contract\Exception\InvalidPushException;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Model\PrePushOriginalExecutorInterface;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverage;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitTool;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverage;
use Symfony\Component\Console\Output\OutputInterface;

class PrePushToolHandler implements CommandHandlerInterface
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
    private function execute($remote, $url)
    {
        /** @var ConfigurationDataResponse $configurationData */
        $configurationData = $this->queryBus->handle(new ConfigurationDataFinder());
        $prePushResponse = $configurationData->getPrePush();

        if (true === $prePushResponse->isPrePush()) {
            $this->output->writeln(self::PRE_PUSH_HOOK);
            $this->executeOriginalHook(
                $remote,
                $url,
                $prePushResponse->getErrorMessage(),
                $prePushResponse->isEnableFaces()
            );

            $phpunitResponse = $prePushResponse->getPhpUnit();

            if (true === $phpunitResponse->isPhpunit()) {
                $this->commandBus->handle(
                    new PhpUnitTool(
                        $phpunitResponse->isPhpunitRandomMode(),
                        $phpunitResponse->getPhpunitOptions(),
                        $prePushResponse->getErrorMessage(),
                        $prePushResponse->isEnableFaces()
                    )
                );

                $phpunitStrictCoverageResponse = $prePushResponse->getPhpUnitStrictCoverage();

                if (true === $phpunitStrictCoverageResponse->isPhpunitStrictCoverage()) {
                    $this->commandBus->handle(
                        new StrictCoverage(
                            $phpunitStrictCoverageResponse->getMinimum(),
                            $prePushResponse->getErrorMessage(),
                            $prePushResponse->isEnableFaces()
                        )
                    );
                }

                $phpunitGuardCoverageResponse = $prePushResponse->getPhpUnitGuardCoverage();

                if (true === $phpunitGuardCoverageResponse->isEnabled()) {
                    $this->commandBus->handle(
                        new GuardCoverage($phpunitGuardCoverageResponse->getWarningMessage())
                    );
                }
            }

            $this->output->writeln(
                GoodJobLogoResponse::paint($prePushResponse->getRightMessage(), $prePushResponse->isEnableFaces())
            );
        }
    }

    /**
     * @param string $remote
     * @param string $url
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws InvalidPushException
     */
    private function executeOriginalHook($remote, $url, $errorMessage, $enableFaces)
    {
        $response = $this->prePushOriginalExecutor->execute($remote, $url);

        if (null != $response) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage, $enableFaces));

            throw new InvalidPushException();
        }
    }

    /**
     * @param CommandInterface|PrePushTool $command
     *
     * @throws InvalidPushException
     */
    public function handle(CommandInterface $command)
    {
        $this->execute($command->getRemote(), $command->getUrl());
    }
}
