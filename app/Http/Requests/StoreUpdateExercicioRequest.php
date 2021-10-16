<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateExercicioRequest extends FormRequest
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
            'name' => "required|min:3|max:255|unique:exercicio,name,{$this->segment(3)},id",
            'foco' => "required",
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute deve ser preenchido com valores numéricos.',
            'min' => 'O campo :attribute requer um mínimo de :min caracteres.',
            'max' => 'O campo :attribute não pode exceder :max caracteres.',
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome requer um mínimo de :min caracteres.',
            'name.max' => 'O campo nome não pode exceder :max caracteres.',
        ];
    }
}
