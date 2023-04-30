<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\ExpressionLanguage\Compiler;

final class FactoryCompiler
{
    /**
     * @param string|array<string, mixed>|null $method
     * @param string|array<string, mixed>|null $attributes
     */
    public function __invoke(
        string $name,
        string|array|null $method,
        string|array|null $attributes,
        string|null $accessor,
    ): string {
        return '';
    }
}
