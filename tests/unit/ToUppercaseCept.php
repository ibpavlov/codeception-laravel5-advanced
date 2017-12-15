<?php
$I = new \UnitTester($scenario);
$toUppercase = new \App\Test\ToUppercase();
$result = $toUppercase->convert("hello");
$I->assertEquals("HELLO", $result);