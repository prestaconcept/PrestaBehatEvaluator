Feature:
  As a test user
  I want to evaluate input string
  So that I can transform them in more complex objects

  Scenario:
    Given the local storage contains:
      | <datetime_immutable("2023-01-01")> |
      | <datetime("today")>                |
    When I format the datetime entries of the local storage with "d/m/Y"
    Then the local storage should contain:
      | 01/01/2023                   |
      | <datetime("today", "d/m/Y")> |
