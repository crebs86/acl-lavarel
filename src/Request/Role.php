<?php

namespace Crebs86\Acl\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class Role extends FormRequest
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
            'name' => 'required|between:4,55|unique:roles,name,'.$id,
            'desc' => 'required|between:10,175'
        ];
    }
}
