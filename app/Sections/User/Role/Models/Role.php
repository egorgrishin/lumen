<?php

namespace Sections\User\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sections\User\User\Models\User;

class Role extends Model
{
    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
