<?php

namespace PhpGitHooks\Module\Git\Service;

use Bruli\EventBusBundle\QueryBus\QueryBus;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Git\Contract\Exception\InvalidCommitMessageException;
use PhpGitHooks\Module\Git\Model\CommitMessageFinderInterface;
use PhpGitHooks\Module\Git\Model\MergeValidatorInterface;
use Symfony\Component\Console\Input\InputInterface;

class CommitMsgTool
{
    /**
     * @var MergeValidatorInterface
     */
    private $mergeValidator;
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * @var CommitMessageFinderInterface
     */
    private $commitMessageFinder;

    /**
     * CommitMsgTool constructor.
     *
     * @param MergeValidatorInterface      $mergeValidator
     * @param QueryBus                     $queryBus
     * @param CommitMessageFinderInterface $commitMessageFinder
     */
    public function __construct(
        MergeValidatorInterface $mergeValidator,
        QueryBus $queryBus,
        CommitMessageFinderInterface $commitMessageFinder
    ) {
        $this->mergeValidator = $mergeValidator;
        $this->queryBus = $queryBus;
        $this->commitMessageFinder = $commitMessageFinder;
    }

    /**
     * @param InputInterface $input
     *
     * @throws InvalidCommitMessageException
     */
    public function run(InputInterface $input)
    {
        /** @var ConfigurationDataResponse $configurationDataResponse */
        $configurationDataResponse = $this->queryBus->handle(new ConfigurationDataFinder());

        if (true === $configurationDataResponse->getCommitMsg()->isCommitMsg()) {
            $commitContent = $this->commitMessageFinder->find($input->getFirstArgument());

            $regularExpression = $configurationDataResponse->getCommitMsg()->getRegularExpression();
            $validMessage = $this->isValidCommitMessage($regularExpression, $commitContent);

            if (false === $validMessage) {
                throw new InvalidCommitMessageException(
                    sprintf(
                        'Invalid Commit message: commit message does not match regex %s !',
                        $regularExpression
                    )
                );
            }
        }
    }

    /**
     * @param string $regularExpression
     * @param string $commitMessage
     *
     * @return bool
     */
    private function isValidCommitMessage($regularExpression, $commitMessage)
    {
        return $this->mergeValidator->isMerge() || preg_match(sprintf('/%s/', $regularExpression), $commitMessage);
    }
}
