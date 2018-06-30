<?php

namespace Crebs86\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'branch_line', 'address', 'sector', 'full_name', 'avatar'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
