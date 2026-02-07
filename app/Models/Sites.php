<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sites extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        "slug",
        "name",
        "address"
    ];

    public function stocks(): HasMany{
        return $this->hasMany(Stock::class, "site_id")->withTrashed();
    }
}
