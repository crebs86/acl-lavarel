<?php

namespace Crebs86\Acl\Request;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'full_name'=>'required|min:5|max:105|min:10',
            'address'=>'required|max:105|min:2',
            'sector'=>'required|max:55|min:2',
            'branch_line'=>'required|max:55',
        ];
    }
}
