<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkerTypes extends Model
{
    //

    protected $fillable = [
        "slug",
        "name",
        "description"
    ];

    public function workers(): HasMany{
        return $this->hasMany(Workers::class, "worker_type_id")->withTimestamps()->withTrashed();
    }
}
