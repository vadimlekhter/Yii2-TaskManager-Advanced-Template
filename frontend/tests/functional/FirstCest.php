<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class FirstCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    /**
     * @dataProvider pageProvider
     * @var $I
     * @var $links
     */
    public function tryToTest(FunctionalTester $I, \Codeception\Example $links)
    {
        $I->amOnPage($links['url']);
        $I->see($links['activeLink'], 'li.active>a');
    }


    /**
     * @return array
     */
    protected function pageProvider()
    {
        return [
            ['url'=>"/site/", 'activeLink'=>"Home"],
            ['url'=>"/site/about", 'activeLink'=>"About"],
            ['url'=>"/site/contact", 'activeLink'=>"Contact"]
        ];
    }

}
