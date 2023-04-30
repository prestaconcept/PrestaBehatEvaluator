<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\Factory;

final class MethodArgumentGuesser implements ArgumentGuesserInterface
{
    public function __invoke(array|string|null $method, array|string|null $attributes, string|null $accessor): string
    {
        if (\is_string($method)) {
            return $method;
        }

        return 'find';
    }
}
