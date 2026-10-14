<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Evaluator;

use Doctrine\Common\Collections\ArrayCollection;
use Presta\BehatEvaluator\Exception\UnexpectedTypeException;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AccessorArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\AttributesArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\MethodArgumentGuesser;
use Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory\MinArgumentGuesser;
use Presta\BehatEvaluator\Foundry\FactoryClassFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class FactoryEvaluator
{
    public function __construct(private readonly FactoryClassFactory $factoryClassFactory)
    {
    }

    /**
     * @param array<string, mixed> $arguments
     * @param string|array<string, mixed>|null $method
     * @param string|array<string, mixed>|null $min
     * @param string|array<string, mixed>|null $attributes
     */
    public function __invoke(
        array $arguments,
        string $name,
        string|array|null $method = null,
        string|array|null $min = null,
        string|array|null $attributes = null,
        string|null $accessor = null,
    ): mixed {
        $originalMethod = $method;
        $originalMin = $min;
        $originalAttributes = $attributes;
        $originalAccessor = $accessor;

        $method = (new MethodArgumentGuesser())($originalMethod, $originalMin, $originalAttributes, $originalAccessor);
        $min = (new MinArgumentGuesser())($originalMethod, $originalMin, $originalAttributes, $originalAccessor);
        $attributes = (new AttributesArgumentGuesser())(
            $originalMethod,
            $originalMin,
            $originalAttributes,
            $originalAccessor,
        );
        $accessor = (new AccessorArgumentGuesser())(
            $originalMethod,
            $originalMin,
            $originalAttributes,
            $originalAccessor,
        );

        $factoryClass = $this->factoryClassFactory->fromName($name);

        $callable = [$factoryClass, $method];
        if (!\is_callable($callable)) {
            throw new \BadMethodCallException('You must define a valid factory method.');
        }

        if (\in_array($method, ['find', 'findBy'], true) && (null === $attributes || [] === $attributes)) {
            throw new \LogicException('A search method must be given attributes to search for.');
        }

        $value = match (true) {
            \is_numeric($min) && \is_array($attributes) => \call_user_func($callable, $min, $attributes),
            \is_numeric($min) && !\is_array($attributes) => \call_user_func($callable, $min),
            !\is_numeric($min) && \is_array($attributes) => \call_user_func($callable, $attributes),
            default => \call_user_func($callable),
        };

        if (null !== $accessor) {
            if (!\is_object($value)) {
                throw new UnexpectedTypeException($value, 'object');
            }

            return PropertyAccess::createPropertyAccessor()->getValue($value, $accessor);
        }

        switch (true) {
            case \is_array($value):
                $value = new ArrayCollection($value);
                break;
        }

        return $value;
    }
}
