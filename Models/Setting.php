<?php

namespace Crebs86\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name', 'label', 'validate_mail', 'ac_account', 'protect_register_form', 'protect_register_form_admin', 'menu_show_users', 'active'
    ];
    public $timestamps = false;
}
