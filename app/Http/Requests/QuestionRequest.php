<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class QuestionRequest extends FormRequest
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
        return [
            'grade_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'body' => 'required|string',
            'explanation' => 'required|string',
            'correct_answer' => 'required|string',
            'incorrect_answer_1' => 'required|string',
            'incorrect_answer_2' => 'required|string',
            'incorrect_answer_3' => 'required|string',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     *  @return array
     */
    public function filters()
    {
        return [];
    }
}
