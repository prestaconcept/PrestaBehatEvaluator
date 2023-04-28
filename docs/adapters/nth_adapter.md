# NthAdapter

The [NthAdapter][1] transforms the input value from a nth representation into it's numeric value.

Ex. The string `"1st"` will be transformed into `1`.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\NthAdapter;

$evaluate = new NthAdapter();
$value = $evaluate('10th');

// $value is equal to 10
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/NthAdapter.php
[2]: ../../README.md
[3]: ../adapters/
