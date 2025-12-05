<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workers extends Model
{
    //
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone",
        "worker_type_id"
    ];

    public function site(): BelongsTo{
        return $this->belongsTo(Sites::class, "site_id")->withTimestamps()->withTrashed();
    }

    public function allocations(): HasMany{
        return $this->hasMany(Allocations::class, "worker_id")->withTimestamps()->withTrashed();
    }

    public function type(): BelongsTo{
        return $this->belongsTo(WorkerTypes::class, "worker_type_id")->withTimestamps()->withTrashed();
    }
}
