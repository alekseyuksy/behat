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

    private $urls = [
        'WIKI' => "https://en.wikipedia.org/wiki/Main_Page"
    ];

    /**
     * @Given I open :page
     *
     * @param string
     */
    public function goToPage($page)
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('chrome');

        $session = new \Behat\Mink\Session($driver);

        $session->start();
        $session->visit($this->urls[$page]);

        $this->session = $session;
        $this->page = $session->getPage();
    }

    /**
     * @When I fill search with value :value
     *
     * @param string $value
     */
    public function fillInputById($value)
    {
        $field = $this->page->findById("searchInput");
        $field->setValue($value);
    }

    /**
     *
     * @When I press search button
     */
    public function pressButtonWithId()
    {
        $button = $this->page->findById( "searchButton");
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
