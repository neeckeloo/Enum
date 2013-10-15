Enum
====

Enum module for Zend Framework 2

[![Build Status](https://secure.travis-ci.org/neeckeloo/Enum.png?branch=master)](http://travis-ci.org/neeckeloo/Enum)
[![Coverage Status](https://coveralls.io/repos/neeckeloo/Enum/badge.png)](https://coveralls.io/r/neeckeloo/Enum)

Configuration
-------------

#### Adapters

- Enum\Adapter\DoctrineAdapter (config/enum-doctrine.local.php.dist)
- Enum\Adapter\ZendDbdapter (config/enum-zenddb.local.php.dist) à venir

Usage
-----

#### Enumeration data

Enumerations:

| id   | name       |
|------|------------|
| 1    | Civility   |
| 2    | Status     |

Enumeration items:

| id | enum_id | value | short_name | long_name |
|----|---------|-------|------------|-----------|
| 1  | 1       | 1     | Mr         | Mister    |
| 2  | 1       | 2     | Mrs        | Mistress  |
| 3  | 2       | 1     | Valid      | Valid     |
| 4  | 2       | 2     | Invalid    | Invalid   |

#### Use view helper to show enumeration value

```php
<?php
// Mister
echo $this->enum(1, 1);

// Mr
echo $this->enum(1, 1, array('mode' => \Enum\EnumManager::SHORT));

// Mistress
echo $this->enum(2, 1);

// Mrs
echo $this->enum(2, 1, array('mode' => \Enum\EnumManager::SHORT));

// Valid
echo $this->enum(1, 2);

// Valid
echo $this->enum(1, 2, array('mode' => \Enum\EnumManager::SHORT));

// Invalid
echo $this->enum(2, 2);

// Invalid
echo $this->enum(2, 2, array('mode' => \Enum\EnumManager::SHORT));
```