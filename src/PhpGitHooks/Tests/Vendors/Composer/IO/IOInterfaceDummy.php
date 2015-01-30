<?php

namespace PhpGitHooks\Tests\Vendors\Composer\IO;

use Composer\Config;
use Composer\IO\IOInterface;

/**
 * Class IOInterfaceDummy
 * @package PhpGitHooks\Tests\Vendors\Composer\IO
 */
class IOInterfaceDummy implements IOInterface
{
    /** @var  string */
    private $ask;

    /**
     * @param string $ask
     */
    public function setAsk($ask)
    {
        $this->ask = $ask;
    }

    /**
     * Is this input means interactive?
     *
     * @return bool
     */
    public function isInteractive()
    {
        // TODO: Implement isInteractive() method.
    }

    /**
     * Is this output verbose?
     *
     * @return bool
     */
    public function isVerbose()
    {
        // TODO: Implement isVerbose() method.
    }

    /**
     * Is the output very verbose?
     *
     * @return bool
     */
    public function isVeryVerbose()
    {
        // TODO: Implement isVeryVerbose() method.
    }

    /**
     * Is the output in debug verbosity?
     *
     * @return bool
     */
    public function isDebug()
    {
        // TODO: Implement isDebug() method.
    }

    /**
     * Is this output decorated?
     *
     * @return bool
     */
    public function isDecorated()
    {
        // TODO: Implement isDecorated() method.
    }

    /**
     * Writes a message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     */
    public function write($messages, $newline = true)
    {
        // TODO: Implement write() method.
    }

    /**
     * Overwrites a previous message to the output.
     *
     * @param string|array $messages The message as an array of lines or a single string
     * @param bool         $newline  Whether to add a newline or not
     * @param integer      $size     The size of line
     */
    public function overwrite($messages, $newline = true, $size = null)
    {
        // TODO: Implement overwrite() method.
    }

    /**
     * Asks a question to the user.
     *
     * @param string|array $question The question to ask
     * @param string       $default  The default answer if none is given by the user
     *
     * @return string The user answer
     *
     * @throws \RuntimeException If there is no data to read in the input stream
     */
    public function ask($question, $default = null)
    {
        return $this->ask;
    }

    /**
     * Asks a confirmation to the user.
     *
     * The question will be asked until the user answers by nothing, yes, or no.
     *
     * @param string|array $question The question to ask
     * @param bool         $default  The default answer if the user enters nothing
     *
     * @return bool true if the user has confirmed, false otherwise
     */
    public function askConfirmation($question, $default = true)
    {
        // TODO: Implement askConfirmation() method.
    }

    /**
     * Asks for a value and validates the response.
     *
     * The validator receives the data to validate. It must return the
     * validated data when the data is valid and throw an exception
     * otherwise.
     *
     * @param string|array $question  The question to ask
     * @param callback     $validator A PHP callback
     * @param bool|integer $attempts  Max number of times to ask before giving
     *                                up (false by default, which means infinite)
     * @param string       $default   The default answer if none is given by the user
     *
     * @return mixed
     *
     * @throws \Exception When any of the validators return an error
     */
    public function askAndValidate($question, $validator, $attempts = false, $default = null)
    {
        // TODO: Implement askAndValidate() method.
    }

    /**
     * Asks a question to the user and hide the answer.
     *
     * @param string $question The question to ask
     *
     * @return string The answer
     */
    public function askAndHideAnswer($question)
    {
        // TODO: Implement askAndHideAnswer() method.
    }

    /**
     * Get all authentication information entered.
     *
     * @return array The map of authentication data
     */
    public function getAuthentications()
    {
        // TODO: Implement getAuthentications() method.
    }

    /**
     * Verify if the repository has a authentication information.
     *
     * @param string $repositoryName The unique name of repository
     *
     * @return boolean
     */
    public function hasAuthentication($repositoryName)
    {
        // TODO: Implement hasAuthentication() method.
    }

    /**
     * Get the username and password of repository.
     *
     * @param string $repositoryName The unique name of repository
     *
     * @return array The 'username' and 'password'
     */
    public function getAuthentication($repositoryName)
    {
        // TODO: Implement getAuthentication() method.
    }

    /**
     * Set the authentication information for the repository.
     *
     * @param string $repositoryName The unique name of repository
     * @param string $username       The username
     * @param string $password       The password
     */
    public function setAuthentication($repositoryName, $username, $password = null)
    {
        // TODO: Implement setAuthentication() method.
    }

    /**
     * Loads authentications from a config instance
     *
     * @param Config $config
     */
    public function loadConfiguration(Config $config)
    {
        // TODO: Implement loadConfiguration() method.
    }
}
