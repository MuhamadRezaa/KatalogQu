<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // Added this line
use Illuminate\Support\Str;
use App\Models\CatalogTemplate;

class TemplatePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'catalog_template_id',
        'amount',
        'discount_amount',
        'final_amount',
        'payment_method',
        'payment_status',
        'payment_details',
        'paid_at',
        'download_token',
        'download_count',
        'max_downloads',
        'expires_at'
    ];

    protected $casts = [
        'payment_details' => 'array',
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2'
    ];

    /**
     * Get the user that owns the template purchase.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the catalog template that was purchased.
     */
    public function catalogTemplate(): BelongsTo
    {
        return $this->belongsTo(CatalogTemplate::class);
    }

    /**
     * Get the payment associated with the template purchase.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'transaction_id', 'transaction_id');
    }

    /**
     * Scope a query to only include purchases with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    /**
     * Scope a query to only include paid purchases.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Check if purchase is paid.
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if purchase is pending.
     */
    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    /**
     * Check if purchase has failed.
     */
    public function isFailed(): bool
    {
        return in_array($this->payment_status, ['failed', 'refunded']);
    }

    /**
     * Check if download is still available.
     */
    public function canDownload(): bool
    {
        return $this->isPaid() && 
               $this->download_count < $this->max_downloads && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }

    /**
     * Increment download count.
     */
    public function incrementDownload(): bool
    {
        if ($this->canDownload()) {
            $this->increment('download_count');
            return true;
        }
        return false;
    }

    /**
     * Generate a new download token.
     */
    public function generateDownloadToken(): string
    {
        $token = Str::random(32);
        $this->update(['download_token' => $token]);
        return $token;
    }

}