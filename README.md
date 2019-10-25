# DoctrineDataFixture Module for Zend Framework 3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rvdlee/doctrine-data-fixture-module.svg?style=flat-square)](https://packagist.org/packages/rvdlee/doctrine-data-fixture-module)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rvdlee/doctrine-data-fixture-module/badges/quality-score.png)](https://scrutinizer-ci.com/g/rvdlee/DoctrineDataFixtureModule)
[![Total Downloads](https://img.shields.io/packagist/dt/rvdlee/doctrine-data-fixture-module.svg?style=flat-square)](https://packagist.org/packages/rvdlee/doctrine-data-fixture-module)
[![GitHub license](https://img.shields.io/github/license/rvdlee/DoctrineDataFixtureModule.svg)](https://github.com/rvdlee/DoctrineDataFixtureModule/blob/master/LICENSE)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/epicsoftworks)

## Introduction

This is a port for ZF3 of Hounddog's orignal code to make fixtures supported in the form of a CLI command.

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
$ composer require rvdlee/doctrine-data-fixture-module
```

Then open `config/application.config.php` and add `DoctrineModule`, `DoctrineORMModule` and 
`DoctrineDataFixtureModule` to your `modules`

#### Registering Fixtures

To register fixtures with Doctrine module add the fixtures in your configuration.

```php
<?php

return [
    'doctrine' => [
        'fixture' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        ]
    ]
];
```

Alternativly you can overwrite the executor that fires off the fixtures. I've made an dist file you can follow to make your own. Executors fall in the service category if you need to make a factory for one.

```php
<?php

return [
    'rvdlee' => [
        'doctrine-data-fixture' => [
            'executor' => YourExecutor::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            YourExecutor::class => YourExecutorFactory::class,
        ],
    ],
];
```
 
## Usage

### Command Line
Access the Doctrine command line as following from your project root:
```sh
$ ./vendor/bin/doctrine-module data-fixture:import 
```

### Why use a custom Executor?

I've made fixtures based on entity meta-data or route config for example. A custom executor can provide such information and pass it along to your fixtures.
