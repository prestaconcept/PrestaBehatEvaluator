# Getting started

The goal of this library is to evaluate expressions and transform them into something else.

The most common usage of this library is to enhance your [Behat steps][1] to write more powerful yet more concise tests.

## Prequisites

If you plan to use it with Behat make sure you have it [installed][2].

## Usage

### With Behat

Remember the [Faker providers][3] evaluated by [Nelmio Alice][4]?

The idea is (almost) the same here, but less focused on generating random data than it is on generating complex values (such as objects) or dynamic ones (such as relative dates).

#### Example with Nelmio Alice

```gherkin
Feature:
  As a user with an account
  I should be able to login
  So that I have access to the restricted area

  Scenario: Login with valid credentials
    Given the database contains the following:
    """
    App\Entity\User:
      admin:
        email: 'john.doe@gmail.com'
        password: 'P4$$w0rd'
        role: '@role_admin'
        birthDate: <(DateTime("1970-01-01"))>
        enabled: true

    App\Entity\Role:
      role_admin:
        label: '<word()>'
    """
    When I login as "john.doe@gmail.com" with password "P4$$w0rd"
    Then I should see the current date in the "Last connected at" section
```

In this example we use [Nelmio Alice][4] and [Faker providers][3] to load data in the database.

The step `the database contains the following:` parses the input value (a Yaml formatted `PyStringNode`) and turns it into entities.
It allows us to deal with relations (`@role_admin` refers to the `App\Entity\Role` entity), to generate complex values (`<(DateTime("1970-01-01")>` generates a `\DateTime`), and to generate random content (`<word()>` generates a random word).

This is not too bad but in my opinion it grows very verbose very quickly.
In a real world example, you probably have bigger entities with many properties, some of them being required while irrelevant for the purpose of the test.
With Nelmio Alice however, you have to set all these properties, and even though you can generate random values, this usually gets very painful to maintain.
For example if you add/rename/remove properties in your entities, you'll have to adapt all of your features to reflect these changes, even if these properties are not relevant for most of your tests (they just need to be set with a random value).

Also you don't really have a way out of the box with Behat to generate complex values in an average step.
Let's pretend you want to evaluate the current date, you would have to create a step like `I should see the current date in the "Last connected at" section`.

You could generalize it, but it would be something you would have to repeat on every single project you work on.

#### Example with this library

To solve the "irrelevant required properties" issue, and also because of it's very good integration with the Symfony ecosystem, I started to use [Zenstruck Foundry][5] a while ago.
I'm not going to dwell on how it works here, but just know that it allows to centralize generating the default values for entities (and it supports [Faker providers][3] out of the box).

Remains the problem of evaluating complex and dynamic values in Behat steps.

Let's see how this library addresses these issues.

```gherkin
Feature:
  As a user with an account
  I should be able to login
  So that I have access to the restricted area

  Scenario: Login with valid credentials
    Given the database contains a "role"
    And the database contains a "user" like:
      | email              | password | role                       | birthDate                | enabled |
      | john.doe@gmail.com | P4$$w0rd | <factory("role", "first")> | <datetime("1970-01-01")> | true    |
    When I login as "john.doe@gmail.com" with password "P4$$w0rd"
    Then I should see "Last connected at: <datetime('today')>"
```

The steps `the database contains a "role"` and `the database contains a "user" like:` are custom steps (that can be generalized, I'm working on another library to address this) which use [Zenstruck Foundry][5] under the hood to load data in the database.
Much more concise than with the previous notation, right?

You probably noticed that they seem to support some special placeholders like `<factory("role", "first")>` and `<datetime("1970-01-01")>`.
If you are familiar with the `TableNode` notation, you will also notice that the values being evaluated as strings, the `enabled` property which seems to be a boolean won't accept the string `"true"` as value.

You probably also noticed that the step `I should see "Last connected at: <datetime('today')>"` has been slightly reworked to accept the same kind of placeholders.

Well this is all the point of that library.

> The goal of this library is to evaluate expressions and transform them into something else.

[More details here][10].

### With pure PHP

You may also want to use this library outside of a Behat context.

It's very possible!

All you need is to instantiate the [Presta\BehatEvaluator\Evaluator][6] with a collection of [Presta\BehatEvaluator\Adapter\AdapterInterface][7] and invoke it with the value you want to evaluate.

> Simple as that!

[More details here][11].

## How it works?

The entrypoint of the library is the [Presta\BehatEvaluator\Evaluator][6] class.

It takes a collection of [Presta\BehatEvaluator\Adapter\AdapterInterface][7] which will be invoked sequentially to evaluate an input value.

Each adapter is responsible to decide whether or not it should modify the input value.
Internally, they may use simple PHP functions, regexes or even the [Symfony Expression Language][8] component to evaluate and modify the input value.

In the end, the value will be returned after having been transformed (or not) by one or several adapters.

## What's next?

- return to the [README][9]
- find out how to integrate this library in your [behat tests][10]
- find out how to [use the evaluator][11] in plain PHP
- find out how to [build the evaluator][12] with the dedicated builder
- read the [adapters guides][13]

[1]: https://behat.org/en/latest/user_guide/writing_scenarios.html#steps
[2]: https://behat.org/en/latest/quick_start.html#installation
[3]: https://fakerphp.github.io/formatters/
[4]: https://github.com/nelmio/alice/blob/master/doc/customizing-data-generation.md#faker-data
[5]: https://github.com/zenstruck/foundry
[6]: ../src/Evaluator.php
[7]: ../src/Adapter/AdapterInterface.php
[8]: https://symfony.com/doc/current/components/expression_language.html
[9]: ../README.md
[10]: ./behat.md
[11]: ./evaluator.md
[12]: ./evaluator_builder.md
[13]: ./adapters/
