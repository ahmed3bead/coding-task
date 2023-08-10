<?php

namespace App\MyApp\Users\Requests\Auth;
use Munjz\Base\Http\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

    }

}
