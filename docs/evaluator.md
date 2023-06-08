# Evaluator

The [Evaluator][1] delegates evaluating the input value to it's inner collection of adapters.

Each registered adapter will be triggered and may modify the input value.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\AdapterInterface;
use Presta\BehatEvaluator\Evaluator;

/** @var list<AdapterInterface> $adapters */
$adapters = [
    // ...
];

$evaluate = new Evaluator($adapters);
$value = $evaluate('any value');
```

---

You may return to the [README][2] or read the [adapters][3] guides.

[1]: ../src/Evaluator.php
[2]: ../README.md
[3]: ./adapters/
