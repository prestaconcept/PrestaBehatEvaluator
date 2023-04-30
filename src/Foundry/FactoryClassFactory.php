<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Foundry;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Zenstruck\Foundry\ModelFactory;

final class FactoryClassFactory
{
    private readonly string $namespace;
    private readonly Inflector $inflector;

    public function __construct(string $namespace = 'App\\Foundry\\Factory\\', Inflector $inflector = null)
    {
        if (!\str_ends_with($namespace, '\\')) {
            $namespace .= '\\';
        }

        $this->namespace = $namespace;
        $this->inflector = $inflector ?? InflectorFactory::create()->build();
    }

    public function fromName(string $name): string
    {
        $name = implode('\\', array_map([$this->inflector, 'classify'], explode('/', $name)));

        $factoryClass = "$this->namespace{$name}Factory";
        if (!\is_a($factoryClass, ModelFactory::class, true)) {
            throw new \InvalidArgumentException('You must define a valid factory class.');
        }

        return $factoryClass;
    }
}
