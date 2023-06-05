# EvaluatorBuilder

The [EvaluatorBuilder][1] build an [Evaluator][2] after configuring a few options.

## Usage

```php
$builder = new EvaluatorBuilder();

// allows you to add a custom adapter
$builder->registerAdapter($customAdapter);

// the default is "en_US"
$builder->withCulture('fr_FR');

// the default is "App\\Foundry\\Factory"
$builder->withFactoryNamespace('Your\Custom\Namespace');

// the default is created using InflectorFactory::create()->build()
$builder->withInflector($inflector);

$evaluator = $builder->build();
```

---

You may return to the [README][2] or read the [behat][3], the [evaluator][4] or the [adapters][5] guides.

[1]: ../src/Evaluator.php
[2]: ../README.md
[3]: ./behat.md
[4]: ./evaluator.md
[5]: ./adapters/
