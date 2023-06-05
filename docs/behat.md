# Behat

## Usage

When creating a [Behat step][1], you may get inputs as parameters.

Sometimes you'll need to evaluate these parameters to transform the placeholder(s) they may contain.

You can do that very easily by using the [Evaluator][4] provided by this library.

#### Using the [Friends of Behat's SymfonyExtension][3]

This extension allows you to take advantage of the dependency injection.

You should be able to inject the [Evaluator][4] in your custom [Behat Context][2]'s constructor and invoke it out of the box.

```php
<?php

namespace App\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Presta\BehatEvaluator\Evaluator;

final class MyContext implements Context
{
    public function __construct(private readonly Evaluator $evaluate)
    {
    }

    /**
     * @Then I should see :text
     */
    public function assertPageTextContains(string $text): void
    {
        $text = ($this->evaluate)($text);

        // ...
    }
}
```

The [Evaluator][4]'s configuration can be customized through dependency injection:

```yaml
services:
  _instanceof:
    Adapter:
      tags: ['app.presta_behat_adapter']

  App\Adapter\CustomAdapter:
    tags: ['app.presta_behat_adapter']

  Presta\BehatEvaluator\Evaluator:
    arguments:
      $adapters: !tagged_iterator 'app.presta_behat_adapter'

  Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage:
    arguments:
      $culture: 'fr_FR'

  Presta\BehatEvaluator\Foundry\FactoryClassFactory:
    arguments:
      $namespace: 'Your\Custom\Namespace'
```

#### Using without dependency injection

There is also a way to use the [Evaluator][4] easily without dependency injection.

The class exposes 2 static methods that use a default configuration which can be easily extended.

```php
<?php

namespace App\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Presta\BehatEvaluator\Evaluator;

final class MyContext implements Context
{
    /**
     * @Given the database contains a :entity like:
     * @Given the database contains an :entity like:
     */
    public function assertPageTextContains(string $entity, TableNode $data): void
    {
        $entity = Evaluator::evaluate($entity);
        $data = array_map(
            static fn (array $attributes): array => Evaluator::evaluateMany($attributes),
            $data->getHash(),
        );

        // ...
    }
}
```

The static methods create an [Evaluator][4] thank's to the [EvaluatorBuilder][5] which allows to customize the configuration.

```php
<?php

namespace App\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Presta\BehatEvaluator\Evaluator;
use Presta\BehatEvaluator\EvaluatorBuilder;

final class MyContext implements Context
{
    /**
     * @Then I should see :text
     */
    public function assertPageTextContains(string $text): void
    {
        $builder = new EvaluatorBuilder();

        // customize the options

        $text = Evaluator::evaluate($text, $builder);

        // ...
    }
}
```

See the [evaluator builder][8] guide for more details.

---

You may return to the [README][6] or read the [evaluator][7], the [evaluator builder][8] or the [adapters][9] guides.

[1]: https://behat.org/en/latest/user_guide/writing_scenarios.html#steps
[2]: https://behat.org/en/latest/user_guide/context.html
[3]: https://github.com/FriendsOfBehat/SymfonyExtension
[4]: ../src/Evaluator.php
[5]: ../src/EvaluatorBuilder.php
[6]: ../README.md
[7]: ./evaluator.md
[8]: ./evaluator_builder.md
[9]: ./adapters/
