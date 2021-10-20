Fisher Yates shuffle
====================

> The easy way shuffles the cards.


The [Fisher-Yates shuffle](https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle) is an algorithm 
for generating a random permutation of a finite sequence - in plain terms, the algorithm shuffles 
the sequence.


**Example:**

```php
use Gambling\Tech\FisherYatesShuffle;

$cards = [0, 1, 2, 3, 4, 5, 6, 7];

$shuffled = (new FisherYatesShuffle())($cards);

$shuffled; // [7, 2, 1, 5, 4, 6, 0, 3]
```

Implementation in file [FisherYatesShuffle.php](https://github.com/nepster-web/gambling-tech/blob/main/src/FisherYatesShuffle.php)

<br>

[Algorithms](https://github.com/nepster-web/gambling-tech/blob/main/docs/guide/algorithms.md) | [Go back](https://github.com/nepster-web/gambling-tech)