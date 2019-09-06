@javascript
Feature: Alice company search

  Scenario: Alice search
    Given I open page "https://en.wikipedia.org/wiki/Main_Page"
    When I fill input by id "searchInput" with value "Alice company"
        And I press button with id "searchButton"
      Then I open first search result page
        And Page heading should be "ALICE (company)"