<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends BaseUuidModel
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
