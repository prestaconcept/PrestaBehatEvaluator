<?php

declare(strict_types=1);

namespace Presta\BehatEvaluator\Tests\Application\Foundry\Factory;

use Presta\BehatEvaluator\Tests\Application\Entity\User;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<User>
 */
final class UserFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return User::class;
    }

    protected function getDefaults(): array
    {
        return [
            'firstname' => self::faker()->firstName(),
            'lastname' => self::faker()->lastName(),
        ];
    }
}
