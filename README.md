php-git-hooks
=============
[![Build Status](https://travis-ci.org/bruli/php-git-hooks.svg?branch=master)](https://travis-ci.org/bruli/php-git-hooks)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/bruli/php-git-hooks/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bruli/php-git-hooks/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/bruli/php-git-hooks/v/stable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![Total Downloads](https://poser.pugx.org/bruli/php-git-hooks/downloads.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![Latest Unstable Version](https://poser.pugx.org/bruli/php-git-hooks/v/unstable.svg)](https://packagist.org/packages/bruli/php-git-hooks) [![License](https://poser.pugx.org/bruli/php-git-hooks/license.svg)](https://packagist.org/packages/bruli/php-git-hooks)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f/mini.png)](https://insight.sensiolabs.com/projects/584eb4ce-7de2-4bb0-9728-5e8be8e4ca3f)

Git hooks for PHP projects.

Library based in git hook scripts for PHP projects, using in [Atrápalo](http://atrapalo.com).

[Original scripts](http://carlosbuenosvinos.com/write-your-git-hooks-in-php-and-keep-them-under-git-control/)

## Installation

### Step 1: Composer

You must add the following line to the `composer.json` file:

``` json
{
    "require-dev": {
        "bruli/php-git-hooks": "1.*@dev"
    }
}
```

If you don't have composer, you need download the  binary file and run it:

``` bash
wget http://getcomposer.org/composer.phar
# or
curl -O http://getcomposer.org/composer.phar

php composer.phar install
```

## Step 2: Configuration
### Composer configuration.
After download all repositories, composer ask you about configuration.

<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/composer_install/Resources/docs/images/composer-config.png" />

### Composer configuration in Symfony2 projects.

In Symfony2 projects you need add this lines in your composer.json:
``` json
"scripts": {
    "post-install-cmd": [
      ...another lines...
      "PhpGitHooks\\Composer\\ConfiguratorScript::buildConfig"
    ],
    "post-update-cmd": [
      ...another lines...
      "PhpGitHooks\\Composer\\ConfiguratorScript::buildConfig"
    ]
```

### Manual config file for git hooks.
You can configure php-git-hooks, creating a php-git-hook.yml file with...

``` yaml
pre-commit:
  execute:
    php-cs-fixer:  true
    phpunit:       true
    phplint:       true
    phpcs:         true
    phpmd:         true
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

``` bash
 $cp vendor/bruli/php-git-hooks/hooks/pre-commit .git/hooks
```

#For commit-msg hook:

``` bash
 $cp vendor/bruli/php-git-hooks/hooks/commit-msg .git/hooks
```

### execute.
<img style="border:1px solid #ccc; padding:1px" src="https://raw.githubusercontent.com/bruli/php-git-hooks/master/Resources/docs/images/pre-commit.png" />

## Credits

* Pablo Braulio ([@brulics](https://twitter.com/brulics))
* [All contributors](https://github.com/bruli/php-git-hooks/graphs/contributors)

## License

php-git-hooks is released under the MIT License. See the bundled LICENSE file for details.
