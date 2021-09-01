<?php

namespace App\Http\Controllers\Api\v1;

use App\Forms\StorePost;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PostController extends Controller
{
    /**
     * @var PostService $service
     */
    private $service;

    /**
     * PostController constructor.
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        $postForm = new StorePost();
        $postForm->loadFromArray($request->all());
        $response = $this->service->store($postForm);

        return response(
            [
                'http-status' => 200,
                'status' => true,
                'msg' => '',
                'body' => [
                    'post' => $response
                ]
            ])->setStatusCode(200);
    }
}
