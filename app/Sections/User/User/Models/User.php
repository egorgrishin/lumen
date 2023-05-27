<?php

namespace Sections\User\User\Models;

use Core\Parents\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Sections\User\Role\Models\Role;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int    $role_id
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    public static array $fields = [
        'id', 'name', 'email',
    ];

    protected $hidden = [
        'password',
        'email_verified_at',
        'deleted_at',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role_id == 1;
    }
}
