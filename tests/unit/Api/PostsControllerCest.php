<?php

namespace Tests\Unit\Api;

use App\Http\Controllers\Api\PostsController;
use App\Http\Requests\PostStoreRequest;
use App\Post;
use Mockery\MockInterface;
use UnitTester;
use Illuminate\Routing\ResponseFactory;

class PostsControllerCest
{
    /** @var PostsController */
    private $postsController;

    /** @var MockInterface|Post */
    private $postMock;
    /** @var MockInterface|ResponseFactory */
    private $responseFactoryMock;

    public function _before()
    {
        $this->postMock = \Mockery::mock(Post::class);
        $this->responseFactoryMock = \Mockery::mock(ResponseFactory::class);

        $this->postsController = new PostsController($this->postMock, $this->responseFactoryMock);
    }

    public function _after(UnitTester $I)
    {
    }

    /**
     * @param UnitTester $I
     */
    public function testIndex(UnitTester $I)
    {
        $this->postMock->shouldReceive('all')->once()->andReturn([]);
        $this->responseFactoryMock->shouldReceive('json')->once()->andReturn([]);
        $response = $this->postsController->index();
        $I->assertEquals([], $response);
    }

    /**
     * @param UnitTester $I
     */
    public function testPost(UnitTester $I)
    {
        /** @var MockInterface|PostStoreRequest $postStoreRequestMock */
        $postStoreRequestMock = \Mockery::mock(PostStoreRequest::class);
        $postStoreRequestMock->shouldReceive('all')->once()->andReturn([]);

        $this->postMock->shouldReceive('create')->once()->andReturn([]);
        $this->responseFactoryMock->shouldReceive('json')->once()->andReturn([]);
        $response = $this->postsController->store($postStoreRequestMock);
        $I->assertEquals([], $response);
    }
}
