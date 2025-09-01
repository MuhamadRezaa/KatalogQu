<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class StoreAdmin extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'user_id',
        'store_id',
        'tenant_id',
        'role',
        'can_manage_products',
        'can_manage_orders',
        'can_manage_settings',
        'can_manage_admins',
        'permissions',
        'last_active_at',
    ];

    protected $casts = [
        'can_manage_products' => 'boolean',
        'can_manage_orders' => 'boolean',
        'can_manage_settings' => 'boolean',
        'can_manage_admins' => 'boolean',
        'permissions' => 'array',
        'last_active_at' => 'datetime',
    ];

    /**
     * Get the user that has this admin role
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the store this admin belongs to
     */
    public function store()
    {
        return $this->belongsTo(UserStore::class, 'store_id');
    }

    /**
     * Check if admin has a specific permission
     */
    public function hasPermission($permission)
    {
        // Owner has all permissions
        if ($this->role === 'owner') {
            return true;
        }

        // For admin-store, check direct boolean permissions
        if (in_array($permission, ['can_manage_products', 'can_manage_orders', 'can_manage_settings', 'can_manage_admins'])) {
            return $this->{$permission};
        }

        // Check permissions array
        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions);
    }
}
