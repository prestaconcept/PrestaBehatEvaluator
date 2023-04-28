# ScalarAdapter

The [ScalarAdapter][1] transforms the input value from a string into it's scalar representation.

Ex. The string `"true"` will be transformed into `true`.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\ScalarAdapter;

$evaluate = new ScalarAdapter();
$value = $evaluate('123');

// $value is equal to 123
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/ScalarAdapter.php
[2]: ../../README.md
[3]: ../adapters/
