<?php

namespace App\Http\Requests\Admin\Detail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRequest extends FormRequest
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
            'day_start' => 'required',
            'day_end' => 'required',
            'amount' => 'required|numeric',
        ];
    }
}
