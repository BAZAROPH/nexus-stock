<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        "slug",
        "name",
        "description",
        "quantity",
        "initial_quantity",
        "characteristics",
        "stock_type_id",
        "creator_id",
        "site_id"
    ];

    protected $casts = [
        'characteristics' => 'array',
    ];

    public function type(): BelongsTo{
        return $this->belongsTo(StockType::class, "stock_type_id");
    }

    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, "creator_id");
    }

    public function site(): BelongsTo{
        return $this->belongsTo(Sites::class, "site_id")->withTrashed();
    }
}
