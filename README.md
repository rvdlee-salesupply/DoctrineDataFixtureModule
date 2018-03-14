# DoctrineDataFixture Module for Zend Framework 3

[![Build Status](https://travis-ci.org/rvdlee-salesupply/DoctrineDataFixtureModule.svg?branch=master)](https://travis-ci.org/rvdlee-salesupply/DoctrineDataFixtureModule)
[![Coverage Status](https://coveralls.io/repos/github/rvdlee-salesupply/DoctrineDataFixtureModule/badge.svg?branch=master)](https://coveralls.io/github/rvdlee-salesupply/DoctrineDataFixtureModule?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rvdlee-salesupply/DoctrineDataFixtureModule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rvdlee-salesupply/DoctrineDataFixtureModule/?branch=master)
[![Percentage of issues still open](http://isitmaintained.com/badge/open/rvdlee-salesupply/DoctrineDataFixtureModule.svg)](http://isitmaintained.com/project/rvdlee-salesupply/DoctrineDataFixtureModule "Percentage of issues still open")
[![Average time to resolve an issue](http://isitmaintained.com/badge/resolution/rvdlee-salesupply/DoctrineDataFixtureModule.svg)](http://isitmaintained.com/project/rvdlee-salesupply/DoctrineDataFixtureModule "Average time to resolve an issue")

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
