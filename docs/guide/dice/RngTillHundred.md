RNG Till Hundred 
================

> A provably fair algorithm for generating a number between 0 and 99.99.


The Provably Fair System (PFS) is the mechanism by which the player
can verify in real time that the results of the games were fair.

Find out all about provably fair system.

**Information sources:**
 - [https://www.provably.com](https://www.provably.com)
 - [https://dicesites.com/provably-fair](https://dicesites.com/provably-fair)



**Example:**

```php
use Gambling\Tech\RngTillHundred;

$serverSeed = 'random hash';
$clientSeed = 'player string';
$nonce = 1;

// your lucky number 
$number = (new RngTillHundred())($serverSeed, $clientSeed, $nonce);
```

Implementation in file [dice/RngTillHundred.php](https://github.com/nepster-web/gambling-tech/blob/main/src/Dice/RngTillHundred.php)

<br>

[Go back](https://github.com/nepster-web/gambling-tech)