# DoctrineDataFixture Module for Zend Framework 3

[![Build Status](https://travis-ci.org/rvdlee-salesupply/DoctrineDataFixtureModule.svg?branch=master)](https://travis-ci.org/rvdlee-salesupply/DoctrineDataFixtureModule)
[![Coverage Status](https://coveralls.io/repos/github/rvdlee-salesupply/DoctrineDataFixtureModule/badge.svg?branch=master)](https://coveralls.io/github/rvdlee-salesupply/DoctrineDataFixtureModule?branch=master)

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
