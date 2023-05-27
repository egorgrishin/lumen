<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Sections\User\User\Models\User;

/**
 * @method User|null user($guard = null)
 */
abstract class BaseRequest extends FormRequest
{
    /**
     * Обработка неудачной попытки авторизации
     */
    protected function failedAuthorization(): void
    {
        throw new HttpResponseException(response()->json([
            'code' => 'THIS_ACTION_IS_UNAUTHORIZED',
        ], 403));
    }

    /**
     * Обработка неудачной попытки валидации
     */
    protected function failedValidation(Validator $validator): void
    {
        $error_key = $this->validator->errors()->keys()[0];
        $error = $validator->errors()->toArray()[$error_key][0];

        throw new HttpResponseException(response()->json([
            'code'    => 'GIVEN_DATA_IS_INVALID',
            'message' => $error
        ], 422));
    }
}
