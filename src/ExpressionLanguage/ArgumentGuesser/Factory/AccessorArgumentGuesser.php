<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory;

final class AccessorArgumentGuesser implements ArgumentGuesserInterface
{
    public function __invoke(
        array|string|null $method,
        array|string|null $attributes,
        string|null $accessor,
    ): string|null {
        if (null === $method) {
            return null;
        }

        if (\is_string($attributes)) {
            return $attributes;
        }

        return $accessor;
    }
}
