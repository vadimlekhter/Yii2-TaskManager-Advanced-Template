<?php

namespace frontend\tests\unit;

use frontend\models\ContactForm;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $a = true;
        $this->assertTrue($a);

        $b = 25;
        $this->assertEquals(25, $b);
        $this->assertLessThan(26, $b);

        $model = new ContactForm ();
        $model->attributes =            [
                'name' => 'First',
                'email' => 'mail@mail.com',
                'subject' => 'Test',
                'body' => 'Test',
                'verifyCode' => 12345
            ];

        expect('model "name" not equals "First"', $model->name)->equals ('First');

        expect('model has not key "email"', $model)->hasKey('email');

    }
}