<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Resources;

enum PriorityEnum: int
{
    case High = -10;
    case Default = 0;
    case Low = 10;
}
