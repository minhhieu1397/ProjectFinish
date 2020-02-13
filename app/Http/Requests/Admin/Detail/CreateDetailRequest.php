<?php

namespace App\Http\Requests\Admin\Detail;

use Illuminate\Foundation\Http\FormRequest;

class CreateDetailRequest extends FormRequest
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
            'tour_id' => 'required',
            'day_start' => 'required',
            'day_end' => 'required',
            'image' => 'required',
            'amount' => 'required|numeric',
            'account' => 'required',
        ];
    }
}
