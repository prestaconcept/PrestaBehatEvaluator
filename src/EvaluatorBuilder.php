<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Presta\BehatEvaluator\Adapter\AdapterInterface;
use Presta\BehatEvaluator\Adapter\ConstantAdapter;
use Presta\BehatEvaluator\Adapter\DateTimeAdapter;
use Presta\BehatEvaluator\Adapter\FactoryAdapter;
use Presta\BehatEvaluator\Adapter\JsonAdapter;
use Presta\BehatEvaluator\Adapter\NthAdapter;
use Presta\BehatEvaluator\Adapter\ScalarAdapter;
use Presta\BehatEvaluator\Adapter\UnescapeAdapter;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;

final class EvaluatorBuilder
{
    /**
     * @var list<AdapterInterface>
     */
    private array $adapters = [];

    private string $culture = 'en_US';

    private string $factoryNamespace = 'App\\Foundry\\Factory';

    private Inflector $inflector;

    public function __construct()
    {
        $this->inflector = InflectorFactory::create()->build();
    }

    public function registerAdapter(AdapterInterface $adapter): self
    {
        $this->adapters[] = $adapter;

        return $this;
    }

    public function withCulture(string $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    public function withFactoryNamespace(string $factoryNamespace): self
    {
        $this->factoryNamespace = $factoryNamespace;

        return $this;
    }

    public function withInflector(Inflector $inflector): self
    {
        $this->inflector = $inflector;

        return $this;
    }

    public function build(): Evaluator
    {
        $expressionLanguage = new ExpressionLanguage(
            new FactoryClassFactory($this->factoryNamespace, $this->inflector),
            $this->culture,
        );

        return new Evaluator(
            [
                new ConstantAdapter($expressionLanguage),
                new DateTimeAdapter($expressionLanguage),
                new FactoryAdapter($expressionLanguage),
                new JsonAdapter(),
                new NthAdapter(),
                new ScalarAdapter(),
                new UnescapeAdapter(),
                ...$this->adapters,
            ],
        );
    }
}
