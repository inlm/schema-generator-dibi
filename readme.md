# Schema Generator - Dibi Bridge

[![Build Status](https://github.com/inlm/schema-generator-dibi/workflows/Build/badge.svg)](https://github.com/inlm/schema-generator-dibi/actions)
[![Downloads this Month](https://img.shields.io/packagist/dm/inlm/schema-generator-dibi.svg)](https://packagist.org/packages/inlm/schema-generator-dibi)
[![Latest Stable Version](https://poser.pugx.org/inlm/schema-generator-dibi/v/stable)](https://github.com/inlm/schema-generator-dibi/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/inlm/schema-generator-dibi/blob/master/license.md)

<a href="https://www.janpecha.cz/donate/schema-generator/"><img src="https://buymecoffee.intm.org/img/donate-banner.v1.svg" alt="Donate" height="100"></a>


## Installation

[Download a latest package](https://github.com/inlm/schema-generator-dibi/releases) or use [Composer](http://getcomposer.org/):

```
composer require inlm/schema-generator-dibi
```

Schema Generator requires PHP 8.0 or later and [Dibi](https://dibiphp.com/) 3.0 or newer.


## Documentation

Supported databases:

* MySQL


### DibiExtractor

It generates schema from existing database.

```php
$connection = new Dibi\Connection(...);
$ignoredTables = ['migrations'];
$extractor = new Inlm\SchemaGenerator\DibiBridge\DibiExtractor($connection, $ignoredTables);
```


### DibiAdapter

It loads schema from existing database.

```php
$connection = new Dibi\Connection(...);
$ignoredTables = ['migrations'];
$extractor = new Inlm\SchemaGenerator\DibiBridge\DibiAdapter($connection, $ignoredTables);
```

**Note:** saving of schema is not supported, use `DibiDumper`.


### DibiDumper

`DibiDumper` executes SQL queries directly in database.


```php
$connection = new Dibi\Connection(...);
$dumper = new Inlm\SchemaGenerator\DibiBridge\DibiDumper($connection);
$dumper->setHeader(array(
	'SET foreign_key_checks = 1;',
));
```

If you need generate `... AFTER column` in `ALTER TABLE` statements, call:

```php
$dumper->enablePositionChanges();
```


------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
