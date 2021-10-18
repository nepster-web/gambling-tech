Generating random values
========================

> The easy way to generate something random.

The generation of random numbers is based on the php function [random_int](https://www.php.net/manual/en/function.random-int.php).
Depending on the operating system, the php interpreter will call the C function, for example 
[getrandom](https://manpages.ubuntu.com/manpages/xenial/en/man2/getrandom.2.html).

By default, getrandom() draws entropy from the /dev/urandom pool.
In Unix-like operating systems, [/dev/random](https://en.wikipedia.org/wiki/dev/random),
[/dev/urandom](https://en.wikipedia.org/wiki/dev/random) and [/dev/arandom](https://en.wikipedia.org/wiki/dev/random) 
are special files that serve as pseudorandom number generators.

For a more detailed understanding of the RNG, study 
[Intel® Digital Random Number Generator (DRNG) Software Implementation Guide](https://www.intel.com/content/www/us/en/developer/articles/guide/intel-digital-random-number-generator-drng-software-implementation-guide.html).


**Example:**

```php
use Gambling\Tech\Random;

Random::getBytes(16); // 3ö1\x18&U\x0Fµòð$ä&ã\x05\x06

Random::getInteger(0, 100); // 7

Random::getBoolean(); // false

Random::getFloat(); // 0.57746288525196

Random::getString(16); // 3Q989ujqa3CAZl0c
```

Implementation in file [Random.php](https://github.com/nepster-web/gambling-tech/blob/main/src/Random.php).

<br>

[Algorithms](https://github.com/nepster-web/gambling-tech/blob/main/docs/guide/algorithms.md) | [Go back](https://github.com/nepster-web/gambling-tech)