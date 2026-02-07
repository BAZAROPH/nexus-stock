<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class StockType extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        "slug",
        "label",
        "description"
    ];

    public function stocks(): HasMany{
        return $this->hasMany(Stock::class, "stock_type_id");
    }
}
