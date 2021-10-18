Rng Till Hundred 
================

------------------

https://github.com/nepster-web/gambling-tech/blob/main/src/Dice/RngTillHundred.php
----


```php
use Gambling\Tech\RngTillHundred;

$serverSeed = 'random hash';
$clientSeed = 'player string';
$nonce = 1;

// your lucky number 
$number = (new RngTillHundred())($serverSeed, $clientSeed, $nonce);
```

<br>

[Go back](https://github.com/nepster-web/gambling-tech)