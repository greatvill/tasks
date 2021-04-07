<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        if ($request->isMethod('post')) {
            return $this->rulesCreate();
        } else {
            return $this->rulesUpdate();
        }
    }

    /**
     * @return string[]
     */
    private function rulesCreate(): array
    {
        return [
            'first_name' => 'required|string|min:2|max:60',
            'middle_name' => 'required|string|min:2|max:60',
            'last_name' => 'string|min:2|max:60',
            'role' => 'required|string|max:20',
            'email' => 'required|unique:users|email',
            'password' => 'required|string|min:8|max:60',
        ];
    }

    private function rulesUpdate(): array
    {
        return [
            'first_name' => 'string|min:2|max:60',
            'middle_name' => 'string|min:2|max:60',
            'last_name' => 'string|min:2|max:60',
            'role' => 'string|max:20',
            'email' => 'email|unique:users',
            'password' => 'string|min:8|max:60',
        ];
    }
}
