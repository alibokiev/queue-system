<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('users.crud');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'string'],
            'password' => ['required', 'confirmed', 'min:6', 'string'],
            'forbidden' => ['required', 'boolean'],
            'language' => ['nullable'],

            'roles' => ['array'],
            'category_id' => ['nullable'],

        ];

//        if (Config::get('admin-auth.activation_enabled')) {
//            $rules['activated'] = ['required', 'boolean'];
//        }

        return $rules;
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getModifiedData(): array
    {
        $data = $this->only(collect($this->rules())->keys()->all());

        $data['language'] = 'en';
        $data['activated'] = true;
        $data['category_id'] = isset($data['category_id']) ? $data['category_id']['id'] : null;

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}