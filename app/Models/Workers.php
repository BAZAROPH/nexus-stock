<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Workers extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone",
        "site_id",
        "worker_type_id"
    ];

    public function site(): BelongsTo{
        return $this->belongsTo(Sites::class, "site_id")->withTrashed();
    }

    public function allocations(): HasMany{
        return $this->hasMany(Allocations::class, "worker_id");
    }

    public function type(): BelongsTo{
        return $this->belongsTo(WorkerTypes::class, "worker_type_id")->withTrashed();
    }
}
