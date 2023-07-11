<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;
use Presta\BehatEvaluator\Exception\UnexpectedTypeException;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AccessorArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AttributesArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\MethodArgumentGuesser;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Zenstruck\Foundry\Proxy;

final class FactoryEvaluator
{
    public function __construct(private readonly FactoryClassFactory $factoryClassFactory)
    {
    }

    /**
     * @param array<string, mixed> $arguments
     * @param string|array<string, mixed>|null $method
     * @param string|array<string, mixed>|null $attributes
     */
    public function __invoke(
        array $arguments,
        string $name,
        string|array|null $method = null,
        string|array|null $attributes = null,
        string|null $accessor = null,
    ): mixed {
        $originalMethod = $method;
        $originalAttributes = $attributes;
        $originalAccessor = $accessor;

        $method = (new MethodArgumentGuesser())($originalMethod, $originalAttributes, $originalAccessor);
        $attributes = (new AttributesArgumentGuesser())($originalMethod, $originalAttributes, $originalAccessor);
        $accessor = (new AccessorArgumentGuesser())($originalMethod, $originalAttributes, $originalAccessor);

        $factoryClass = $this->factoryClassFactory->fromName($name);

        $callable = [$factoryClass, $method];
        if (!\is_callable($callable)) {
            throw new \BadMethodCallException('You must define a valid factory method.');
        }

        if (\in_array($method, ['find', 'findBy'], true) && (null === $attributes || [] === $attributes)) {
            throw new \LogicException('A search method must be given attributes to search for.');
        }

        $value = match (true) {
            \is_array($attributes) => call_user_func($callable, $attributes),
            default => call_user_func($callable),
        };

        if (null !== $accessor) {
            if (!$value instanceof Proxy) {
                throw new UnexpectedTypeException($value, Proxy::class);
            }

            return PropertyAccess::createPropertyAccessor()->getValue($value->object(), $accessor);
        }

        switch (true) {
            case \is_array($value):
                $value = new ArrayCollection(array_map(static fn (Proxy $proxy): object => $proxy->object(), $value));
                break;

            case $value instanceof Proxy:
                $value->disableAutoRefresh();
                break;
        }

        return $value;
    }
}
