<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'setup_data',
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
        'setup_data' => 'array',
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
}
