<?php
/** @var \Codeception\Scenario $scenario */
$I = new ApiTester($scenario);
$I->sendPOST("/api/posts", [
    'title' => 'Game of Rings',
    'body' => 'By George Tolkien'
]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'title' => 'Game of Rings'
]);