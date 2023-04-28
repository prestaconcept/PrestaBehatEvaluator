# ConstantAdapter

The [ConstantAdapter][1] transforms the input value from the string representation of a constant into it's value.

Ex. The value `<constant("ARRAY_FILTER_USE_BOTH")>` will be transformed into `1`.

## Usage

Given there is a class like:

```php
<?php

namespace App\Model;

final class Role
{
    public const ROLE_USER = 'user';
}
```

Then the following should happen:

```php
<?php

use Presta\BehatEvaluator\Adapter\ConstantAdapter;

$evaluate = new ConstantAdapter(...);
$value = $evaluate('<constant("App\Model\Role::ROLE_USER")>');

// $value is equal to 'user'
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/ConstantAdapter.php
[2]: ../../README.md
[3]: ../adapters/
