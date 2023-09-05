# JsonAdapter

The [JsonAdapter][1] decode the input JSON string into a PHP array.

Ex. The string `"{"foo": "bar"}"` will be transformed into `['foo' => 'bar']`.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\JsonAdapter;

$evaluate = new JsonAdapter();
$value = $evaluate('["foo", "bar"]');

// $value is equal to ['foo', 'bar']
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/JsonAdapter.php
[2]: ../../README.md
[3]: ../adapters/
