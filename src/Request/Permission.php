<?php

namespace Crebs86\Acl\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class Permission extends FormRequest
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
        $id = request('id') == null ? '' : Crypt::decryptString(request('id'));
        return [
            'name'=>'required|min:5|max:55|unique:permissions,name,'.$id,
            'desc'=>'required|min:10|max:175'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Defina um nome para a permissão',
            'name.min'=>'Nome deve conter no mínimo 5 catacteres',
            'name.max'=>'Nome deve conter no máximo 55 catacteres',
            'name.unique'=>'Já exite uma permissão com este nome',
            'desc.required'=>'Insira uma descrição da permissão',
            'desc.min'=>'Descrição deve conter no mínimo 10 catacteres',
            'desc.max'=>'Descrição deve conter no máximo 175 catacteres',
        ];
    }
}
