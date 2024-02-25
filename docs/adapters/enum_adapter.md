# ConstantAdapter

The [EnumAdapter][1] transforms the input value from the string representation of a backed enum case into it's value.

Ex. The value `<enum("App\Enum\StatusEnum::Doing")>` will be transformed into the `StatusEnum`'s `Doing` case.

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

### Requesting the enum

```php
<?php

use Presta\BehatEvaluator\Adapter\EnumAdapter;

$evaluate = new EnumAdapter(...);
$value = $evaluate('<enum("App\Enum\StatusEnum::Doing")>');

// $value is the StatusEnum::Doing enum's case
```

### Requesting the enum's name

```php
<?php

use Presta\BehatEvaluator\Adapter\EnumAdapter;

$evaluate = new EnumAdapter(...);
$value = $evaluate('<enum("App\Enum\StatusEnum::Doing", "name")>');

// $value is equal to 'Doing'
```

### Requesting the enum's value

```php
<?php

use Presta\BehatEvaluator\Adapter\EnumAdapter;

$evaluate = new EnumAdapter(...);
$value = $evaluate('<enum("App\Enum\StatusEnum::Todo", "value")>');

// $value is equal to 'todo'
```

_Note that when evaluating a larger string, the second argument is optional._

```php
<?php

use Presta\BehatEvaluator\Adapter\EnumAdapter;

$evaluate = new EnumAdapter(...);
$value = $evaluate('The status is <enum("App\Enum\StatusEnum::Done")>.');

// $value is equal to 'The status is done.'
```

---

You may return to the [README][2] or read other [adapters][3] guides.

[1]: ../../src/Adapter/EnumAdapter.php
[2]: ../../README.md
[3]: ../adapters/
