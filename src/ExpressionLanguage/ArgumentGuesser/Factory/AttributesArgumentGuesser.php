<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory;

final class AttributesArgumentGuesser implements ArgumentGuesserInterface
{
    /**
     * @return array<string, mixed>|null
     */
    public function __invoke(
        array|string|null $method,
        array|string|null $attributes,
        string|null $accessor,
    ): array|null {
        if (\is_array($method)) {
            return $method;
        }

        if (\is_array($attributes)) {
            return $attributes;
        }

        return null;
    }
}
