<?php

namespace PhpGitHooks\Application\CommitMessage;

use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infrastructure\CommitMessage\ExtractCommitMessage;
use PhpGitHooks\Infrastructure\Common\FileExtractInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use PhpGitHooks\Infrastructure\Git\MergeValidatorInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class CommitMessageValidator
 * @package PhpGitHooks\Application\CommitMessage
 */
class CommitMessageValidator extends ToolHandler
{
    /** @var  InputInterface */
    private $input;
    /** @var  MergeValidatorInterface */
    private $mergeValidator;
    /** @var  ExtractCommitMessage */
    private $extractCommitMessage;

    /**
     * @param OutputHandler           $outputHandler
     * @param MergeValidatorInterface $mergeValidator
     * @param FileExtractInterface    $extractCommitMessage
     */
    public function __construct(
        OutputHandler $outputHandler,
        MergeValidatorInterface $mergeValidator,
        FileExtractInterface $extractCommitMessage
    ) {
        $this->mergeValidator = $mergeValidator;
        $this->extractCommitMessage = $extractCommitMessage;
        parent::__construct($outputHandler);
    }

    /**
     * @param InputInterface $input
     */
    public function setInput(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * @throws InvalidCommitMessageException
     */
    public function validate()
    {
        $this->outputHandler->setTitle('Checking commit message');
        $this->outputHandler->getTitle();
        $commitMessage = $this->extractCommitMessage->extract($this->input->getFirstArgument());

        if (!$this->isValidMessage($commitMessage)) {
            throw new InvalidCommitMessageException();
        }

        $this->outputHandler->getSuccessfulStepMessage();
    }

    /**
     * @param  string $commitMessage
     * @return bool
     */
    private function isValidMessage($commitMessage)
    {
        return $this->mergeValidator->isMerge() || preg_match('/#[0-9]{2,7}/', $commitMessage);
    }
}
