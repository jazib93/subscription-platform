<?php

namespace App\Http\Controllers\Api\v1;

use App\Forms\StoreWebsite;
use App\Services\WebsiteService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class WebsiteController extends Controller
{
    /**
     * @var WebsiteService $service
     */
    private $service;

    /**
     * WebsiteController constructor.
     * @param WebsiteService $service
     */
    public function __construct(WebsiteService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function index(){
        $websites = $this->service->all();
        return response(
            [
                'http-status' => 200,
                'status' => true,
                'msg' => '',
                'body' => [
                    'websites' => $websites
                ]
            ])->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        $websiteForm = new StoreWebsite();
        $websiteForm->loadFromArray($request->all());
        $response = $this->service->store($websiteForm);

        return response(
            [
                'http-status' => 200,
                'status' => true,
                'msg' => '',
                'body' => [
                    'website' => $response
                ]
            ])->setStatusCode(200);
    }
}
