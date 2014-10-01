Feature: Search
  In order to subscribe to newsletter
  As a website user
  I need to be able to subscribe to newsletter

  Scenario: Subscribe to a newsletter
    Given I am on "/"
    When I fill in "email" with "carlos"
    And I press "efl_newsletter_subscription_box_save"
    Then I should see "Actividad"