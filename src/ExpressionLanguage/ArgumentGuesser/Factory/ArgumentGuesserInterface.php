<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory;

/**
 * @phpstan-type FactoryAttributes array<string, mixed>
 */
interface ArgumentGuesserInterface
{
    /**
     * @param FactoryAttributes|string|null $method
     * @param FactoryAttributes|string|null $attributes
     */
    public function __invoke(string|array|null $method, string|array|null $attributes, string|null $accessor): mixed;
}
