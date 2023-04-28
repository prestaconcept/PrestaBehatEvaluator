# UnescapeAdapter

The [UnescapeAdapter][1] strips backslashes off the input string.

Ex. The string `'The string contains an unescaped \\\\ backslash".'` will be transformed into `'The string contains an unescaped \\ backslash".'`.

## Usage

```php
<?php

use Presta\BehatEvaluator\Adapter\UnescapeAdapter;

$evaluate = new UnescapeAdapter();
$value = $evaluate('It\'s time!');

// $value is equal to "It's time!"
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/UnescapeAdapter.php
[2]: ../../README.md
[3]: ../adapters/
