<?php

namespace Munjz\Base\Http;

use Illuminate\Foundation\Http\FormRequest;
use Munjz\Base\RequestValidator;

abstract class BaseRequest extends FormRequest
{
    use RequestValidator;

    public function authorize()
    {

    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
