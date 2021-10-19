<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlunoRequest extends FormRequest
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
            'name' => "required|min:3|max:255",
            'data_nasc' => "required",
            'peso' => "required",
            'altura' => 'required',
            'cpf' => 'required|cpf',
            'telefone' => 'required|celular_com_ddd',
            'objetivo' => 'nullable|min:5|max:200',
            'endereco' => 'required',
            'email' => "required|email:rfc,dns|unique:pessoa,email,{$this->segment(3)},id",
            'password' => 'nullable|min:8|max:40'
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute deve ser preenchido com valores numéricos.',
            'min' => 'O campo :attribute requer um mínimo de :min caracteres.',
            'max' => 'O campo :attribute não pode exceder :max caracteres.',
            'data_nasc.required' => 'O campo data de nascimento é obrigatório.',
            'name.required' => 'O campo nome é obrigatório.',
        ];
    }
}
