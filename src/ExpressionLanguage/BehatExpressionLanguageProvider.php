<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage;

use Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction\ConstantExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

final class BehatExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function __construct()
    {
    }

    public function getFunctions(): array
    {
        return [
            new ConstantExpressionFunction(),
        ];
    }
}
