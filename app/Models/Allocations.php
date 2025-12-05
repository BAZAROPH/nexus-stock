<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Allocations extends Model
{
    //
    protected $fillable = [
        "stock_id",
        "user_id",
        "worker_id",
        "quantity"
    ];

    public function stock(): BelongsTo{
        return $this->belongsTo(Stock::class, "stock_id")->withTimestamps()->withTrashed();
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, "user_id")->withTimestamps()->withTrashed();
    }

    public function worker(): BelongsTo{
        return $this->belongsTo(Workers::class, "worker_id")->withTimestamps()->withTrashed();
    }
}
