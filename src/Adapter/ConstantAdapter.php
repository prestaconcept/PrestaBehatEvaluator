<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Adapter;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;

final class ConstantAdapter implements AdapterInterface
{
    public function __construct(private readonly ExpressionLanguage $expressionLanguage)
    {
    }

    public function __invoke(mixed $value): mixed
    {
        if (!\is_string($value)) {
            return $value;
        }

        preg_match_all('/<(?<expression>constant\([^)]+\))>/', $value, $matches);

        foreach ($matches['expression'] as $expression) {
            $evaluated = $this->expressionLanguage->evaluate($expression);

            // the evaluation did not end up with a transformation
            preg_match('/constant\([\'"](?<value>[^)]+)[\'"]\)/', $expression, $expressionMatches);
            if (\is_string($evaluated) && $expressionMatches['value'] === addslashes($evaluated)) {
                continue;
            }

            // the value only consists in a constant expression
            if ($value === "<$expression>") {
                return $evaluated;
            }

            if (!\is_scalar($evaluated) && !$evaluated instanceof \Stringable) {
                $type = get_debug_type($evaluated);

                throw new \RuntimeException("The evaluated constant of type \"$type\" could not be cast to string.");
            }

            // the expression is included in a larger string
            $value = str_replace("<$expression>", (string) $evaluated, $value);
        }

        return $value;
    }
}
