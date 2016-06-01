php-git-hooks
=============
[![Build Status](https://travis-ci.org/bruli/php-git-hooks.svg?branch=master)](https://travis-ci.org/bruli/php-git-hooks)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/bruli/php-git-hooks/v/stable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![Total Downloads](https://poser.pugx.org/bruli/php-git-hooks/downloads)](https://packagist.org/packages/bruli/php-git-hooks) [![Latest Unstable Version](https://poser.pugx.org/bruli/php-git-hooks/v/unstable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![License](https://poser.pugx.org/bruli/php-git-hooks/license.svg)](https://packagist.org/packages/bruli/php-git-hooks)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f/mini.png)](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f)

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
      "PhpGitHooks\\Application\\Composer\\ConfiguratorScript::buildConfig"
    ],
    "post-update-cmd": [
      "PhpGitHooks\\Application\\Composer\\ConfiguratorScript::buildConfig"
    ]
}
```

Then, launch `$ composer install` and composer should ask you about configuration

<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/master/Resources/docs/images/composer-config.png" />

**Important:** To use 2.X version you need symfony 2.7 version.

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
    phpunit:
        enabled:     true
        random-mode: true
    phplint:         true
    phpcs:
        enabled:     true
        standard:    PSR2
    phpmd:           true
    composer:        true
  message:
    right-message: 'HEY, GOOD JOB!!'
    error-message: 'FIX YOUR CODE!!'
commit-msg:
    enabled: true
    regular-expression: '#[0-9]{2,7}'
```

... or you can copy php-git-hooks.yml.sample from vendor/bruli/php-git-hooks.

### Update from v1.3.*

Php-cs-fixer configuration in php-git-hooks.yml file, is not compatible with 2.0 version.
You should remove php-cs-fixer entry and execute "composer install".

Most easy way to update is delete php-git-hooks.yml and execute "composer install". You will see all the configuration questions again.

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
$ cp vendor/bruli/php-git-hooks/hooks/pre-commit .git/hooks
```

#For commit-msg hook:

```bash
$ cp vendor/bruli/php-git-hooks/hooks/commit-msg .git/hooks
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
