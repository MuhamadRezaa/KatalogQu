<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'catalog_template_id',
        'store_name',
        'subdomain',
        'store_description',
        'store_logo',
        'store_phone',
        'store_email',
        'store_address',
        'setup_status',
        'setup_completed_at',
        'payment_transaction_id',
        'tenant_id',
        'tenant_created',
        'setup_data', // SECURITY ENHANCEMENT: Store template and customer data
        'is_active',
        'activated_at',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'whatsapp_number',
        'maintenance_mode'
    ];

    protected $casts = [
        'setup_completed_at' => 'datetime',
        'activated_at' => 'datetime',
        'setup_data' => 'array', // SECURITY ENHANCEMENT: Cast to array for JSON storage
        'is_active' => 'boolean',
        'tenant_created' => 'boolean',
        'maintenance_mode' => 'boolean'
    ];

    /**
     * Get the user that owns the store
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the catalog template
     */
    public function catalogTemplate()
    {
        return $this->belongsTo(CatalogTemplate::class);
    }

    /**
     * Get the payment transaction
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_transaction_id', 'transaction_id');
    }

    /**
     * SECURITY ENHANCEMENT: Get template purchase record
     */
    public function templatePurchase()
    {
        return $this->hasOne(\App\Models\TemplatePurchase::class, 'transaction_id', 'payment_transaction_id');
    }

    /**
     * Get the tenant associated with the user store.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    /**
     * Get all admins for this store
     */
    public function admins()
    {
        return $this->hasMany(StoreAdmin::class, 'store_id');
    }

    /**
     * Get the owner admin record for this store
     */
    public function owner()
    {
        return $this->hasOne(StoreAdmin::class, 'store_id')
            ->where('role', 'owner');
    }

    /**
     * Get the heroes for the store.
     */
    public function heroes(): HasMany
    {
        return $this->hasMany(StoreHero::class);
    }

    /**
     * SECURITY ENHANCEMENT: Check if store setup can be completed
     */
    public function canCompleteSetup()
    {
        // Must have payment transaction and be in pending status
        return $this->payment_transaction_id &&
            in_array($this->setup_status, ['pending', 'in_progress']) &&
            !$this->is_active;
    }

    /**
     * SECURITY ENHANCEMENT: Get template data from setup_data
     */
    public function getTemplateData()
    {
        $setupData = $this->setup_data ?? [];
        return $setupData['template_data'] ?? null;
    }

    /**
     * SECURITY ENHANCEMENT: Get customer data from setup_data
     */
    public function getCustomerData()
    {
        $setupData = $this->setup_data ?? [];
        return $setupData['customer_data'] ?? null;
    }

    /**
     * SECURITY ENHANCEMENT: Check if payment was initiated
     */
    public function hasPaymentInitiated()
    {
        $setupData = $this->setup_data ?? [];
        return isset($setupData['payment_initiated_at']);
    }

    /**
     * SECURITY ENHANCEMENT: Get payment initiated timestamp
     */
    public function getPaymentInitiatedAt()
    {
        $setupData = $this->setup_data ?? [];
        return $setupData['payment_initiated_at'] ?? null;
    }

    /**
     * SECURITY ENHANCEMENT: Scope for pending stores
     */
    public function scopePending($query)
    {
        return $query->where('setup_status', 'pending');
    }

    /**
     * SECURITY ENHANCEMENT: Scope for stores awaiting validation
     */
    public function scopePendingValidation($query)
    {
        return $query->where('setup_status', 'pending_validation');
    }

    /**
     * SECURITY ENHANCEMENT: Scope for completed stores
     */
    public function scopeCompleted($query)
    {
        return $query->where('setup_status', 'completed')->where('is_active', true);
    }

    /**
     * SECURITY ENHANCEMENT: Boot method to add model events
     */
    protected static function boot()
    {
        parent::boot();

        // Log when setup status changes
        static::updating(function ($model) {
            if ($model->isDirty('setup_status')) {
                \Illuminate\Support\Facades\Log::info('UserStore setup_status changed', [
                    'store_id' => $model->id,
                    'from' => $model->getOriginal('setup_status'),
                    'to' => $model->setup_status,
                    'transaction_id' => $model->payment_transaction_id
                ]);
            }
        });

        // Log when store is activated
        static::updating(function ($model) {
            if ($model->isDirty('is_active') && $model->is_active) {
                $model->activated_at = now();
                \Illuminate\Support\Facades\Log::info('UserStore activated', [
                    'store_id' => $model->id,
                    'store_name' => $model->store_name,
                    'subdomain' => $model->subdomain,
                    'user_id' => $model->user_id
                ]);
            }
        });
    }
}
