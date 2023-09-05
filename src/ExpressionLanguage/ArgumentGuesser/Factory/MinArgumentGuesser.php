<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory;

final class MinArgumentGuesser implements ArgumentGuesserInterface
{
    public function __invoke(
        array|string|null $method,
        array|string|null $min,
        array|string|null $attributes,
        string|null $accessor,
    ): int|null {
        if (\is_numeric($min)) {
            return (int)$min;
        }

        return null;
    }
}
