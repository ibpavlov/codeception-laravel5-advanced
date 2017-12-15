<?php
namespace Tests\Unit;

use App\Test\ToUppercase;

class ToUppercaseCest
{
    /** @var ToUppercase */
    private $toUppercase;

    public function _before(\UnitTester $I)
    {
        $this->toUppercase = new ToUppercase();
    }

    public function testConvert(\UnitTester $I)
    {
        $result = $this->toUppercase->convert("hello");
        $I->assertEquals("HELLO", $result);
    }
}