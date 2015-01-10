pbp-wp-plugins
==============

## I. Introduction

A plugin suite for WordPress, offering support for play by post games.
It still needs to be discussed if it is a set of plugins, or just a plugin with more features.

Also, there is the possibility to also create a theme (or set of themes) for this kind of games.

## II. Installation

### 1. Core plugin installation:

Copy the contents of this repository in your wp-content/plugins directory.

### 2. Unit Tests

You will need to setup your environment so you can run phpUnit tests and Wordpress Tests Suite.

#### 2.1 Installing pre requirements

* Follow [this instructions](https://github.com/sebastianbergmann/phpunit#installation) for installing [PHPUnit](www.phpunit.de).
* Read about WordPress automated testing [here](https://make.wordpress.org/core/handbook/automated-testing/ ).
* Install [WP CLI](http://wp-cli.org/#install).
* Install WP CLI Plugin unit tests following the guid found [here](https://github.com/wp-cli/wp-cli/wiki/Plugin-Unit-Tests).

#### 2.2 Running the unit tests

All tests for this plugin can be found in tests/ folder.
There are two distinct types of tests: Unit Tests and Integration Tests

##### a) Unit Tests
* found under `tests/unit/`
* They have no dependence to database, and the classes depend only on `PHPUnit_Framework_TestCase`
* they have their own config and bootstrap `files/`
* you can run from the `pbp-wp-core-plugin/tests` directory using:
```
phpunit --debug --configuration phpunit.xml
```
    
##### b) Integration Tests
* Found under `tests/integration/`
* Depend on wp test database
* Test classes usually extend `WP_UnitTestCase`
* Have their own config and bootstrap `files/`
* you can run from the `pbp-wp-core-plugin/tests` directory using:
```
phpunit --debug --configuration phpunit-integration.xml
```