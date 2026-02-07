<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        "slug",
        "label",
        "description"
    ];

    public function permissions(): BelongsToMany{
        return $this->belongsToMany(Permissions::class, 'permission_role', 'role_id', 'permission_id')->withTimestamps();
    }

    public function users(): HasMany{
        return $this->hasMany(User::class, 'role_id');
    }
}
