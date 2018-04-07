<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
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
            'lane_id' => 'required|exists:lanes,id',
            'title' => 'required|max:300',
            'description' => 'max:3000'
        ];
    }
}
