<p align="center">
    <h1 align="center">Gambling Tech on PHP</h1>
</p>

<p align="center">
    <a href="https://packagist.org/packages/nepster-web/gambling-tech"><img src="https://shields.io/packagist/v/nepster-web/gambling-tech.svg?include_prereleases" alt="Release"></a>
    <a href="https://travis-ci.com/github/nepster-web/gambling-tech"><img src="https://travis-ci.org/nepster-web/gambling-tech.svg?branch=master" alt="Build"></a>
    <a href="https://scrutinizer-ci.com/g/nepster-web/gambling-tech/?b=master"><img src="https://scrutinizer-ci.com/g/nepster-web/gambling-tech/badges/coverage.png?b=master" alt="Coverage"></a>
    <a href="https://packagist.org/packages/nepster-web/gambling-tech"><img src="https://img.shields.io/packagist/dt/nepster-web/gambling-tech.svg" alt="Downloads"></a>
    <a href="https://packagist.org/packages/nepster-web/gambling-tech"><img src="https://img.shields.io/packagist/l/nepster-web/gambling-tech" alt="License"></a>
</p>


Introduction
------------

**Gambling Tech** - is a library that provides certified casino algorithms.
(for example: [RNG](https://en.wikipedia.org/wiki/Random_number_generation), 
[PFS](https://www.provably.com), 
[Fisher Yates](https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle), etc).


Requirements
------------

You'll need at least PHP 7.4 (it works best with PHP 8).


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

Either run

```
php composer.phar require --prefer-dist nepster-web/gambling-tech
```

or add

```
"nepster-web/gambling-tech": "*"
```


:computer: Basic Usage
----------------------

**Random generation:**
```php
use Gambling\Tech\Random;

Random::getBytes(16); // 3ö1\x18&U\x0Fµòð$ä&ã\x05\x06
Random::getInteger(0, 100); // 7
Random::getBoolean(); // false
Random::getFloat(); // 0.57746288525196
Random::getString(16); // 3Q989ujqa3CAZl0c
```

**Shuffling:**
```php
use Gambling\Tech\FisherYatesShuffle;

$cards = [0, 1, 2, 3, 4, 5, 6, 7];

$shuffled = (new FisherYatesShuffle())($cards);

$shuffled; // [7, 2, 1, 5, 4, 6, 0, 3]
```

Read more about other algorithms in the [documentation](./docs/guide/algorithms.md).


### Testing

To run the tests locally, in the root directory execute below

```
./vendor/bin/phpunit
```

---------------------------------

## :book: Documentation

See [the official guide](./docs/guide/README.md).


## :books: Resources

* [Documentation](./docs/guide/README.md)
* [Issue Tracker](https://github.com/nepster-web/gambling-tech/issues)


## :newspaper: Changelog

Detailed changes for each release are documented in the [CHANGELOG.md](./CHANGELOG.md).


## :lock: License

See the [MIT License](LICENSE) file for license rights and limitations (MIT).