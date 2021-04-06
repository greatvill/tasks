<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TaskRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:30',
            'card_id' => 'required|integer',
            'creator_id' => 'required|integer',
            'creator_type' => 'required|string|max:30',
            'executor_id' => 'required|integer'
        ];
    }
}
