<?php

namespace Tests\Api;

use ApiTester;
use App\Constants\Roles;
use App\Library\Queue;
use App\Model\User;
use App\Library\Auth\User\Authentication as UserAuth;
use Codeception\Example;
use Codeception\Util\HttpCode;
use Illuminate\Support\Facades\Auth;

/**
 * Test all basic rest requests
 */
class RestCest
{
    /**
     * @return array
     */
    protected function endpoints()
    {
        return [
            ['endpoint' => 'posts'],
            //...
            //Other RESTful objects
        ];
    }

    /**
     * @param ApiTester $I
     * @return mixed
     */
    private function authenticate(ApiTester $I)
    {
        $user = factory(\App\User::class)->create();
        //$I->haveHttpHeader("token", $user->getToken());
        return $user;
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @dataprovider endpoints
     */
    public function testListForbidden(ApiTester $I, Example $example)
    {
        $I->sendGet('/api/'.$example['endpoint']);
        //Should be forbidden if we have auth layer
        //$I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     */
    public function testList(ApiTester $I, Example $example)
    {
        $I->sendGet('/api/'.$example['endpoint']);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     * @todo enhance method
     */
    /**public function testRead(ApiTester $I, Example $example)
    {
        $model = factory($example['model'])->create();
        $I->sendGet('/api/'.$example['endpoint'].'/'.$model->id);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }**/

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     */
    public function testReadNotFound(ApiTester $I, Example $example)
    {
        $I->sendGet('/api/'.$example['endpoint'].'/'.sq());
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     * @todo fix and add
     */
    /**
    public function testCreate(ApiTester $I, Example $example)
    {
        $I->sendPost('/api/'.$example['endpoint'], []);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
    }
     * **/

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     */
    public function testUpdateNotFound(ApiTester $I, Example $example)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPUT('/api/'.$example['endpoint'].'/'.sq());
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @before authenticate
     * @dataprovider endpoints
     */
    public function testDeleteNotFound(ApiTester $I, Example $example)
    {
        $I->sendDELETE('/api/'.$example['endpoint'].'/'.sq());
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
    }


}