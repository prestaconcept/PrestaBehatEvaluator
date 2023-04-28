# DateTimeAdapter

The [DateTimeAdapter][1] transforms the input value from a string into it's (possibly formatted) DateTime(Immutable) representation.

Ex. The string `'<datetime("2023-06-01", format: "d/m/Y")>'` will be transformed into `'01/06/2023'`.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\DateTimeAdapter;

$evaluate = new DateTimeAdapter();
$value = $evaluate('<datetime_immutable("tomorrow")>');

// $value is equal to `new \DateTimeImmutable('tomorrow')`
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/DateTimeAdapter.php
[2]: ../../README.md
[3]: ../adapters/
