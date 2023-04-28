<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction;

use Presta\BehatEvaluator\ExpressionLanguage\Compiler\DateTimeCompiler;
use Presta\BehatEvaluator\ExpressionLanguage\Evaluator\DateTimeEvaluator;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class DateTimeExpressionFunction extends ExpressionFunction
{
    public function __construct(string $culture)
    {
        parent::__construct(
            'datetime',
            new DateTimeCompiler(),
            new DateTimeEvaluator(static fn (string $time): \DateTime => new \DateTime($time), $culture),
        );
    }
}
