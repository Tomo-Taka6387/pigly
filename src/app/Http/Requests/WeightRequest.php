<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
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
     *
     *
     */

    public function rules()
    {
        return [
            'date' => ['required'],
            'weight' => ['required', 'numeric',],
            'calories' => ['required', 'numeric'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_content' => ['required', 'string', 'max:120'],
        ];
    }




    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '４桁までの数字で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.date_format' => '運動時間を入力してください',
            'exercise_content.required' => '120文字以内で入力してください',
            'exercise_content.string' => '120文字以内で入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach (['weight'] as $field) {
                $value = $this->input($field);
                if ($value !== null && preg_match('/^\d+(\.\d+)?$/', $value)) {
                    [$int, $dec] = explode('.', $value . '.');
                    if (strlen($int) > 4) {
                        $validator->errors()->add($field, '4桁までの数値で入力してください。');
                    }
                    if (strlen($dec) > 1) {
                        $validator->errors()->add($field, '小数点は1桁で入力してください。');
                    }
                }
            }
        });
    }
}
