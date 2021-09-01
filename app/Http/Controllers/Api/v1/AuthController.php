<?php

namespace App\Http\Controllers\Api\v1;

use App\Forms\LoginForm;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    /**
     * @var AuthService $authService
     */
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login (Request $request)
    {
        $loginForm = new LoginForm();
        $loginForm->loadFromArray($request->all());
        $response = $this->authService->login($loginForm);
        return $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     */
    public function logout (Request $request)
    {
        $response = $this->authService->logout($request);
        return response(
            [
                'http-status' => 200,
                'status' => true,
                'msg' => __('auth.successful_logout'),
                'body' => null
            ])->setStatusCode(200);
    }
}
