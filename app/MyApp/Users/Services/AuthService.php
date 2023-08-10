<?php

namespace App\MyApp\Users\Services;

use App\MyApp\Users\Repositories\AuthRepository;
use App\MyApp\Users\Requests\Auth\LoginRequest;
use App\MyApp\Users\Requests\Auth\RegisterRequest;
use Munjz\Base\Http\HttpStatus;
use MyApp\Base\Service;

class AuthService extends Service
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Registration
     */
    public function register(RegisterRequest $request): \MyApp\Base\Response
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        return $this->response()->setData(['token' => $this->authRepository->register($this->authRepository->register($data))]);
    }

    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            return $this->response()->setData(['token' => auth()->user()->createToken('LaravelAuthApp')->accessToken]);
        }
        return $this->response()->setData(['error' => 'Unauthorised'])->setStatusCode(HttpStatus::HTTP_UNAUTHORIZED);

    }
}
