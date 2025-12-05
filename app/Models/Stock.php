<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    //

    protected $fillable = [
        "slug",
        "name",
        "description",
        "quantity",
        "characteristics",
        "stock_type_id",
        "creator_id",
        "site_id"
    ];

    public function type(): BelongsTo{
        return $this->belongsTo(StockType::class, "stock_type_id")->withTimestamps()->withTrashed();
    }

    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, "creator_id")->withTimestamps()->withTrashed();
    }

    public function site(): BelongsTo{
        return $this->belongsTo(Sites::class, "site_id")->withTimestamps()->withTrashed();
    }
}
