<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'descricao' => 'bail|required|min:3|max:50',
            'status'    => 'bail|required'
        ];
    }

    public function attributes()
    {
        return [
            'descricao' => 'Descrição',
            'status' => 'Status'
        ];
    }
}
