<?php

namespace PhpGitHooks\Application\CommitMessage;

use PhpGitHooks\Application\Config\ConfigFile;
use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infrastructure\CommitMessage\ExtractCommitMessage;
use PhpGitHooks\Infrastructure\Common\FileExtractInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use PhpGitHooks\Infrastructure\Git\MergeValidatorInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class CommitMessageValidator.
 */
class CommitMessageValidator extends ToolHandler
{
    /** @var  InputInterface */
    private $input;
    /** @var  MergeValidatorInterface */
    private $mergeValidator;
    /** @var  ExtractCommitMessage */
    private $extractCommitMessage;
    /** @var  ConfigFile */
    private $configFile;

    /**
     * @param OutputHandler           $outputHandler
     * @param MergeValidatorInterface $mergeValidator
     * @param FileExtractInterface    $extractCommitMessage
     * @param ConfigFile              $configFile
     */
    public function __construct(
        OutputHandler $outputHandler,
        MergeValidatorInterface $mergeValidator,
        FileExtractInterface $extractCommitMessage,
        ConfigFile $configFile
    ) {
        $this->mergeValidator = $mergeValidator;
        $this->extractCommitMessage = $extractCommitMessage;
        $this->configFile = $configFile;
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
        var_dump($this->configFile->getMessageCommitConfiguration());
        die;

        $this->outputHandler->setTitle('Checking commit message');
        $this->outputHandler->getTitle();
        $commitMessage = $this->extractCommitMessage->extract($this->input->getFirstArgument());

        if (!$this->isValidMessage($commitMessage)) {
            throw new InvalidCommitMessageException();
        }

        $this->outputHandler->getSuccessfulStepMessage();
    }

    /**
     * @param string $commitMessage
     *
     * @return bool
     */
    private function isValidMessage($commitMessage)
    {
        $data = $this->configFile->getMessageCommitConfiguration();

        return $this->mergeValidator->isMerge() || preg_match('/'.$data['regular-expression'].'/', $commitMessage);
    }
}
