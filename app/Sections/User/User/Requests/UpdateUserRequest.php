<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Illuminate\Validation\Rule;
use Sections\User\User\Dto\UpdateUserDto;

class UpdateUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && $user->id == $this->route('user_id');
    }

    public function rules(): array
    {
        return [
            'name'     => 'nullable|string',
            'email'    => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'password' => 'nullable|string',
        ];
    }

    public function toDto(): UpdateUserDto
    {
        return UpdateUserDto::fromRequest($this);
    }
}
