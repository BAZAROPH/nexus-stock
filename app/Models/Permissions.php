<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permissions extends Model
{
    //
    protected $fillable = [
        "slug",
        "label",
        "description"
    ];

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Roles::class, "permissions_role", "permission_id", "role_id")->withTimestamps()->withTrashed();
    }
}
