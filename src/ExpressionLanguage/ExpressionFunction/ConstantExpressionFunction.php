<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction;

use Presta\BehatEvaluator\ExpressionLanguage\Compiler\ConstantCompiler;
use Presta\BehatEvaluator\ExpressionLanguage\Evaluator\ConstantEvaluator;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class ConstantExpressionFunction extends ExpressionFunction
{
    public function __construct()
    {
        parent::__construct('constant', new ConstantCompiler(), new ConstantEvaluator());
    }
}
