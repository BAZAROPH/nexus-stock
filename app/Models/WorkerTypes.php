<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerTypes extends Model implements HasMedia
{
    //
    use InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        "slug",
        "label",
        "description"
    ];

    public function workers(): HasMany{
        return $this->hasMany(Workers::class, "worker_type_id")->withTrashed();
    }
}
