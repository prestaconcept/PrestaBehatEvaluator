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

You may return to the [README][2] or read the [behat][3], the [evaluator builder][4] or the [adapters][5] guides.

[1]: ../src/Evaluator.php
[2]: ../README.md
[3]: ./behat.md
[4]: ./evaluator_builder.md
[5]: ./adapters/
