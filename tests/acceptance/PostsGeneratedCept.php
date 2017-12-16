<?php
//You can use https://chrome.google.com/webstore/detail/codeception-testtools/jhaegbojocomemkcnmnpmoobbmnkijik
/** @var \Codeception\Scenario $scenario */
$I = new AcceptanceTester($scenario);
$I->amOnPage('/posts');
$I->click('Add new post');
$I->seeCurrentURLEquals('/posts/create');
$I->fillField('title', 'test');
$I->fillField('body', 'test new post');
$I->click('Submit');
$I->seeCurrentURLEquals('/posts');
$I->see('test new post');
$I->click('Edit');
$I->see('test new post');
$I->click('Update');
$I->click('Edit');
$I->fillField('body', 'test new post 2');
$I->click('Update');
$I->see('test new post 2');
$I->click('Delete');
$I->seeCurrentURLEquals('/posts');