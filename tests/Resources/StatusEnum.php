<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources;

enum StatusEnum: string
{
    case Todo = 'todo';
    case Doing = 'doing';
    case Done = 'done';
}
