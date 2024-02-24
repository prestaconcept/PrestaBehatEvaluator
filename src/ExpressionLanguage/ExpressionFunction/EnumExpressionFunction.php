<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\ExpressionFunction;

use Presta\BehatEvaluator\ExpressionLanguage\Compiler\ConstantCompiler;
use Presta\BehatEvaluator\ExpressionLanguage\Evaluator\ConstantEvaluator;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;

final class EnumExpressionFunction extends ExpressionFunction
{
    public function __construct()
    {
        parent::__construct('enum', new ConstantCompiler(), new ConstantEvaluator());
    }
}
