<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class UserRequest extends FormRequest
{
    use SanitizesInput;

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
     *  Validation rules to be applied to the input.
     *
     *  @return array
     */
    public function rules()
    {
        $rules = [];
        if($this->getMethod() == 'POST') {
            $rules = [
                'user_name' => 'bail|required|string|max:30|unique:users',
                'email' => 'bail|required|string|email|unique:users|max:255',
                'password' => 'required|string|min:6'];
        }
        elseif($this->getMethod() == 'PUT') {
            $rules = [
                'user_name' => 'bail|required|string|max:30|unique:users,user_name,'.$this->user,
                'email' => 'bail|required|string|email|max:255|unique:users,email,'.$this->user,
                'password' => 'sometimes|nullable|string|min:6',
            ];
        }
        return $rules;
    }

    /**
     *  Filters to be applied to the input.
     *
     *  @return array
     */
    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'user_name' => 'trim|lowercase|escape',
        ];
    }
}