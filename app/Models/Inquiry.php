<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    /** @use HasFactory<\Database\Factories\InquiryFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'product_id',
        'count',
        'comment',
        'status',
    ];

    /**
     * Get the product that owns the inquiry.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
