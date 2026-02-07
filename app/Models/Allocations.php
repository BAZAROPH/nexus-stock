<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

class Allocations extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        "stock_id",
        "user_id",
        "worker_id",
        "quantity",
        "details"
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function stock(): BelongsTo{
        return $this->belongsTo(Stock::class, "stock_id");
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, "user_id");
    }

    public function worker(): BelongsTo{
        return $this->belongsTo(Workers::class, "worker_id")->withTrashed();
    }
}
