<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostIdRequest extends FormRequest
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
            'post' => 'required|integer',
        ];
    }
    
    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
