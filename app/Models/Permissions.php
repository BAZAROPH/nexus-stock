<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Permissions extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        "slug",
        "label",
        "description"
    ];

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Roles::class, "permission_role", "permission_id", "role_id")->withTimestamps();
    }
}
