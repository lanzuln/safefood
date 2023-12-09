<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiltiImage extends Model
{
    use HasFactory;
    protected $guarded =[];
    /**
     * Get the prouct that owns the MiltiImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prouct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
