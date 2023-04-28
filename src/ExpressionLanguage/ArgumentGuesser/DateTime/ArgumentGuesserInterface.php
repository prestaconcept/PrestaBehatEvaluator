<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ArgumentGuesser\DateTime;

/**
 * @phpstan-type IntlFormats array{
 *     date?: 'NONE'|'SHORT'|'MEDIUM'|'LONG',
 *     time?: 'NONE'|'SHORT'|'MEDIUM'|'LONG',
 * }
 */
interface ArgumentGuesserInterface
{
    /**
     * @param IntlFormats|string|null $time
     * @param IntlFormats|string|null $format
     */
    public function __invoke(string|array|null $time = null, string|array|null $format = null): mixed;
}
