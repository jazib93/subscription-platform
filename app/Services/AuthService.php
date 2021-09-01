<?php
namespace App\Services;

use App\Forms\IForm;
use Illuminate\Support\Facades\Hash;
class AuthService
{
    /**
     * @var $userService
     */
    private $userService;

    /**
     * AuthService constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param IForm $form
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(IForm $form){
        $form->validate();
        $user = $this->userService->findByEmail($form->email);
        $msg = '';
        if ($user) {
            if (Hash::check($form->password, $user->password)) {
                $token = $user->createToken('Grant Client')->accessToken;
                $response = [
                    'http-status' => 200,
                    'status' => true,
                    'msg' => __('auth.successful_login'),
                    'body' => [
                        'token' => $token
                    ]
                ];
                return response($response)->setStatusCode(200);
            } else {
                $msg = __('auth.password_mismatch');
            }

        } else {
            $msg = __('auth.password_mismatch');
        }

        $response = [
            'http-status' => 422,
            'status' => false,
            'msg' => $msg,
            'body' => []
        ];
        return response($response)->setStatusCode(422);
    }

    /**
     * @param $request
     * @return bool
     */
    public function logout ($request) {
        $token = $request->user()->token();
        $token->revoke();
        return true;
    }
}
