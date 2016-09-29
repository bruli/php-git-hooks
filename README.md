php-git-hooks
=============
[![Build Status](https://travis-ci.org/bruli/php-git-hooks.svg?branch=master)](https://travis-ci.org/bruli/php-git-hooks)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/bruli/php-git-hooks/v/stable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![Total Downloads](https://poser.pugx.org/bruli/php-git-hooks/downloads)](https://packagist.org/packages/bruli/php-git-hooks) [![Latest Unstable Version](https://poser.pugx.org/bruli/php-git-hooks/v/unstable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![License](https://poser.pugx.org/bruli/php-git-hooks/license.svg)](https://packagist.org/packages/bruli/php-git-hooks)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f/mini.png)](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f)
[![Donate button](https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif)](https://www.paypal.me/brulics)

Git hooks for PHP projects.

Library based in git hook scripts for PHP projects.

## Installation

### Step 1: Composer

You must add the following line to the `composer.json` file to use with Symfony 3.0:

```json
{
    "require-dev": {
        "bruli/php-git-hooks": "~4.1"
    }
}
```
You can use "~2.0" for Symfony version 2.X.

Or you can write in your console:

```bash
$ composer require bruli/php-git-hooks --dev
```

If you don't have composer, you need download the  binary file and run it:

```bash
$ wget http://getcomposer.org/composer.phar
# or
$ curl -O http://getcomposer.org/composer.phar

$ php composer.phar install
```

## Step 2: Configuration

### Using Composer

First, you will need to add the following lines to your `composer.json`

```json
"scripts": {
    "post-install-cmd": [
      "PhpGitHooks\\Infrastructure\\Composer\\ConfiguratorScript::buildConfig"
    ],
    "post-update-cmd": [
      "PhpGitHooks\\Infrastructure\\Composer\\ConfiguratorScript::buildConfig"
    ]
}
```

**WARNING:** "PhpGitHooks\\Application\\Composer\\ConfiguratorScript::buildConfig" is deprecated. You need change by current entry.

Then, launch `$ composer install` and composer should ask you about configuration

<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/master/Resources/docs/images/composer-config.png" />

### Bin directory configuration.

If your project doesn't have a "bin/" directory, you can add this in your `composer.json` file.

```json
"config": {
    "bin-dir": "bin"
}
```

**Note:** This is not necessary for Symfony projects.

### Manual config file for git hooks.

You can configure php-git-hooks, creating a php-git-hooks.yml file with...

```yaml
pre-commit:
  enabled: true
  execute:
    php-cs-fixer:
        enabled:  true
        levels:
            psr0:       true
            psr1:       true
            psr2:       true
            symfony:    true
        options: "--fixers=short_array_syntax --diff"
    phpunit:
        enabled:     true
        random-mode: true
        options:     '<some options>'
        strict-coverage:
             enabled:       true
             minimum:       90
        guard-coverage:
             enabled: true
             message: 'WARNING!!, your code coverage is lower.'
    phplint:         true
    phpcs:
        enabled:     true
        standard:    PSR2
    phpmd:
        enabled:     true
        options:     '<some options>'
    composer:        true
  message:
    right-message: 'HEY, GOOD JOB!!'
    error-message: 'FIX YOUR CODE!!'
commit-msg:
    enabled: true
    regular-expression: '#[0-9]{2,7}'
pre-push:
    enabled: true
    execute:
      phpunit:
        enabled:     true
        random-mode: true
        options:     '<some options>'
    strict-coverage:
        enabled:       true
        minimum:       90
    guard-coverage:
        enabled: true
        message: 'WARNING!!, your code coverage is lower.'
    message:
      right-message: 'PUSH IT!!'
      error-message: 'YOU CAN NOT PUSH CODE!!'
```

... or you can copy php-git-hooks.yml.sample from vendor/bruli/php-git-hooks.

### Config file for phpunit.

If you want use phpunit tool, you must create a phpunit.xml.dist in your project root directory.
Alternatively you can copy from vendor/bruli/php-git-hooks/phpunit.xml.dist in your project root directory.

### Config file for phpmd.

The same case that phpunit. You must create a PmdRules.xml in your project root directory or copy from php-git-hook directory.

## Step 3: Enabling hooks.

The most easy way to enable hook is copy hook file into your .git/hooks directory.

#For pre-commit hook:

You can enable this hooks with composer or manually executing

```bash
$ cp vendor/bruli/php-git-hooks/src/PhpGitHooks/Infrastructure/Hook/pre-commit .git/hooks
```

#For commit-msg hook:

```bash
$ cp vendor/bruli/php-git-hooks/src/PhpGitHooks/Infrastructure/Hook/commit-msg .git/hooks
```

#For pre-push hook:

```bash
$ cp vendor/bruli/php-git-hooks/src/PhpGitHooks/Infrastructure/Hook/pre-push .git/hooks
```

### execute.

####Valid pre-commit.

<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/master/Resources/docs/images/pre-commit.png" />

####Fail pre-commit.

<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/master/Resources/docs/images/pre-commit-failed.png" />

## Credits

* Pablo Braulio ([@brulics](https://twitter.com/brulics))
* [All contributors](https://github.com/bruli/php-git-hooks/graphs/contributors)

## License

php-git-hooks is released under the [MIT License](https://opensource.org/licenses/MIT). See the bundled LICENSE file for details.
