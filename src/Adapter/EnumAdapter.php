<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Adapter;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionLanguage;
use Presta\BehatEvaluator\ExpressionLanguage\ExpressionMatcher\FunctionExpressionMatcher;

final class EnumAdapter implements AdapterInterface
{
    public function __construct(private readonly ExpressionLanguage $expressionLanguage)
    {
    }

    public function __invoke(mixed $value): mixed
    {
        if (!\is_string($value)) {
            return $value;
        }

        $match = new FunctionExpressionMatcher();

        foreach ($match('enum', $value) as $expression) {
            $evaluated = $this->expressionLanguage->evaluate($expression);

            // the evaluation did not end up with a transformation
            preg_match('/enum\([\'"](?<value>[^)]+)[\'"]\)/', $expression, $expressionMatches);
            if (\is_string($evaluated) && $expressionMatches['value'] === addslashes($evaluated)) {
                continue;
            }

            if (!$evaluated instanceof \BackedEnum) {
                $type = get_debug_type($evaluated);

                throw new \RuntimeException("The evaluated enum of type \"$type\" is not a backed enum.");
            }

            // the expression is included in a larger string
            $value = str_replace("<$expression>", (string)$evaluated->value, $value);
        }

        return match (\is_numeric($value)) {
            true => (int)$value,
            false => $value,
        };
    }
}
