<?php
namespace Tests\Unit;

use App\Test\ToUppercase;

class ToUppercaseTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var ToUppercase */
    private $toUppercase;

    protected function _before()
    {
        $this->toUppercase = new ToUppercase();
    }

    public function testConvert()
    {
        $result = $this->toUppercase->convert("hello");
        $this->tester->assertEquals("HELLO", $result);
    }
}