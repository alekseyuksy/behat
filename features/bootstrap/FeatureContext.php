<?php

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends Behat\MinkExtension\Context\MinkContext
{
    /** @var \Behat\Mink\Session $session */
    public $session;

    /** @var \Behat\Mink\Element\DocumentElement $page */
    public $page;

    /**
     * @Given I open page :url
     *
     * @param string $url
     */
    public function goToPage($url)
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('chrome');

        $session = new \Behat\Mink\Session($driver);

        $session->start();
        $session->visit($url);

        $this->session = $session;
        $this->page = $session->getPage();
    }

    /**
     * @When I fill input by id :id with value :value
     *
     * @param string $id
     * @param string $value
     */
    public function fillInputById($id, $value)
    {
        $field = $this->page->findById($id);
        $field->setValue($value);
    }

    /**
     * /**
     * @When I press button with id :id
     *
     * @param string $id
     */
    public function pressButtonWithId($id)
    {
        $button = $this->page->findById($id);
        $button->press();
    }

    /**
     * @When I open first search result page
     */
    public function openFirstSearchResult()
    {
        $link = $this->page->find('xpath', '//li[@class="mw-search-result"][1]//a');
        $link->click();
    }

    /**
     * @When Page heading should be :match
     *
     * @param string $match
     */
    public function checkMatch($match)
    {
        $element = $this->page->find('xpath', '//h1');

        if($element->getHtml() !== $match){
            throw new \Behat\Behat\Tester\Exception\PendingException('Heading not match');
        }
    }
}
