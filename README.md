# DoctrineDataFixture Module for Zend Framework 2

[![Build Status](https://travis-ci.org/Hounddog/DoctrineDataFixtureModule.png)](https://travis-ci.org/Hounddog/DoctrineDataFixtureModule)
[![Coverage Status](https://coveralls.io/repos/Hounddog/DoctrineDataFixtureModule/badge.png?branch=master)](https://coveralls.io/r/Hounddog/DoctrineDataFixtureModule)

## Introduction

This is a port for ZF3 of Hounddog's orignal code to make fixtures supported in the form of a CLI command.

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
$ composer require rvdlee-salesupply/doctrine-data-fixture-module
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

## Usage

#### Command Line
Access the Doctrine command line as following from your project root:
```sh
$ ./vendor/bin/doctrine-module data-fixture:import 
```
