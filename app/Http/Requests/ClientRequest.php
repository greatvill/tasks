<?php

namespace App\Http\Requests;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ClientRequest extends FormRequest
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
            return $this->rulesDefault();
        } else {
            return $this->rulesUpdate();
        }
    }

    /**
     * @return string[]
     */
    private function rulesDefault(): array
    {
        return [
            'name' => 'required|string|min:2|max:60',
            'middle_name' => 'required|string|min:2|max:60',
            'patronymic' => 'string|min:2|max:60',
        ];
    }

    private function rulesUpdate(): array
    {
        return [
            'name' => 'string|min:2|max:60',
            'middle_name' => 'string|min:2|max:60',
            'patronymic' => 'string|min:2|max:60',
        ];
    }
}
