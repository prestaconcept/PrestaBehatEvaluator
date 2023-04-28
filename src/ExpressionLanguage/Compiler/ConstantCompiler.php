<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Compiler;

final class ConstantCompiler
{
    public function __invoke(string $value): string
    {
        return "(is_string($value) ? constant($value) : $value)";
    }
}
