Feature: Create Products

  # Note how were identifying 2 unique products and referencing them independently
  Scenario: Create 2 products and modify the price
    Given there is a product A "Book" priced at 10
    And there is also product B "Pencil"
    And the product A price is 12
    And the product B price is 52
    And i dump the store

  # Note how were identifying a "product" and then we're referencing the product using "its" in the following step
  Scenario: Create a product and modify the price
    Given there is a product "Book" priced at 10
    When its price is changed to 50
    Then its price is 50
    And i dump the store