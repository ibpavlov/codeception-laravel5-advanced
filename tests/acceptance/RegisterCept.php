<?php
/** @var \Codeception\Scenario $scenario */
$I = new AcceptanceTester($scenario);
$I->amOnPage('/register');
$I->see('Name');
$I->see('Confirm Password');
$I->see('Register');
$I->fillField('name', 'Ivelin');
$I->fillField('email', 'ibpavlov'.sq().'@mailinator.com');
$I->fillField('password', 'qwerty');
$I->fillField('password_confirmation', 'qwerty');
$I->click('Register', 'button');
$I->see('Hello world!');
$I->see('Logged in');
$I->see('Logout');