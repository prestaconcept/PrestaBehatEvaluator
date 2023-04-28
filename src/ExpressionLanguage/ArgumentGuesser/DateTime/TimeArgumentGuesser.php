<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\DateTime;

final class TimeArgumentGuesser implements ArgumentGuesserInterface
{
    private const DEFAULT = 'now';

    public function __invoke(string|array|null $time = null, string|array|null $format = null): string
    {
        foreach ([$time, $format] as $argument) {
            if (!\is_string($argument)) {
                continue;
            }

            try {
                new \DateTime($argument);

                return $argument;
            } catch (\Throwable) {
            }
        }

        return self::DEFAULT;
    }
}
