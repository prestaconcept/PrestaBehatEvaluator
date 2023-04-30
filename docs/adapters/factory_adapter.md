# FactoryAdapter

The [FactoryAdapter][1] transforms the input value from a string into the result of a [zenstruck/foundry][2] factory method.

Ex. The string `'<factory("user", "findBy", {"lastname": "Doe"})>'` will be transformed into a collection of user entities having "Doe" for lastname in the database.

## Usage

### Fetch an entity with a simple name

Given there is an entity like:
```php
<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column]
    public string $firstname;

    #[ORM\Column]
    public string $lastname;

    #[ORM\Column]
    public string $email;
}
```
And there is 1 user whose firstname is "John"
Then the following should be true

```php
<?php

use App\Entity\User;
use Presta\BehatEvaluator\Adapter\FactoryAdapter;

$evaluate = new FactoryAdapter();
$value = $evaluate('<factory("user", {"firstname": "John"})>');

\assert($value instanceof User);
\assert('John' === $value->firstname);
```

### Count entities with a compound name

Given there is an entity like:
```php
<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class UserGroup
{
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column]
    public string $name;
}
```
And there are 3 user groups, 1 of which being named "Manager"
Then the following should be true

```php
<?php

use Presta\BehatEvaluator\Adapter\FactoryAdapter;

$evaluate = new FactoryAdapter();
$value = $evaluate('<factory("user group", "count", {"name": "Manager"})>');

\assert(1 === $value);
```

### Get the value of a property of an entity in a sub namespace

Given there is an entity like:
```php
<?php

namespace App\Entity\User;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Role
{
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column]
    public string $name;
}
```
And there is 1 user role named "Admin"
Then the following should be true

```php
<?php

use Presta\BehatEvaluator\Adapter\FactoryAdapter;

$evaluate = new FactoryAdapter();
$value = $evaluate('<factory("user/role", {"name": "Admin"}, "name")>');

\assert('Admin' === $value);
```

---

You may return to the [README][3] or read other [adapters][4] guides.

[1]: ../../src/Adapter/FactoryAdapter.php
[2]: https://github.com/zenstruck/foundry
[3]: ../../README.md
[4]: ../adapters/
