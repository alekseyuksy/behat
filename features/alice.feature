@javascript
Feature: Alice company search

  Scenario Outline: Alice search
    Given I open <page>
    When I fill search with value <search>
        And I press search button
      Then I open first search result page
        And Page heading should be <heading>

    Examples:
      | page   |      search          | heading                 |
      | "WIKI" |  "Alice company"     |  "ALICE (company)"      |
      | "WIKI" |  "BMW"               |  "BMW (company)"      |