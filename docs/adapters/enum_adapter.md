# ConstantAdapter

The [EnumAdapter][1] transforms the input value from the string representation of a backed enum case into it's value.

Ex. The value `<enum("App\Enum\StatusEnum::Doing")>` will be transformed into the enum's case value.

## Usage

Given there is an enum like:

```php
<?php

namespace App\Enum;

enum StatusEnum: string
{
    case Todo = 'todo';
    case Doing = 'doing';
    case Done = 'done';
}
```

Then the following should happen:

```php
<?php

use Presta\BehatEvaluator\Adapter\EnumAdapter;

$evaluate = new EnumAdapter(...);
$value = $evaluate('<enum("App\Enum\StatusEnum::Doing")>');

// $value is equal to 'doing'
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/EnumAdapter.php
[2]: ../../README.md
[3]: ../adapters/
