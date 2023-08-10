<?php

namespace App\Http\Controllers\API\V1\Users\Auth;

namespace App\Http\Controllers\API\V1\Users\Auth;

use App\Http\Controllers\Controller;
use App\MyApp\Users\Requests\Auth\LoginRequest;
use App\MyApp\Users\Requests\Auth\RegisterRequest;
use App\MyApp\Users\Services\AuthService;
use MyApp\Base\Response;

class PassportAuthController extends Controller
{
    private AuthService $userService;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request): Response
    {
        return $this->service->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }
}
