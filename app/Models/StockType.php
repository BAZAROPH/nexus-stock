<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockType extends Model
{
    //
    protected $fillable = [
        "slug",
        "name",
        "description"
    ];

    public function stocks(): HasMany{
        return $this->hasMany(Stock::class, "stock_type_id")->withTimestamps()->withTrashed();
    }
}
