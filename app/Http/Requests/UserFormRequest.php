<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->user)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => ['required', 'min:6']
        ];
    }
}
