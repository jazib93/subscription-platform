<?php

namespace App\Http\Controllers\Api\v1;

use App\Forms\StoreSubscriber;
use App\Services\SubscriberService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SubscriberController extends Controller
{
    /**
     * @var SubscriberService $service
     */
    private $service;

    /**
     * SubscriberController constructor.
     * @param SubscriberService $service
     */
    public function __construct(SubscriberService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
        $subscriberForm = new StoreSubscriber();
        $subscriberForm->loadFromArray($request->all());
        $response = $this->service->store($subscriberForm);

        return response(
            [
                'http-status' => 200,
                'status' => true,
                'msg' => !($response) ? __('subscribers.already_exist') : true,
                'body' => [
                    'subscriber' => !($response) ? null : $response
                ]
            ])->setStatusCode(200);
    }
}
