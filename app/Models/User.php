<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // SoftDeletes
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BelongsToTenant, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'tenant_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Get the stores this user is an admin for
     */
    public function adminStores()
    {
        return $this->hasMany(StoreAdmin::class);
    }

    /**
     * Get the store this user owns (primary store)
     */
    public function ownedStore()
    {
        return $this->hasOne(UserStore::class);
    }

    /**
     * Check if user is an admin for a specific store
     */
    public function isAdminFor($storeId)
    {
        return $this->adminStores()->where('store_id', $storeId)->exists();
    }

    /**
     * Check if user is the owner of a specific store
     */
    public function isOwnerOf($storeId)
    {
        return $this->adminStores()
            ->where('store_id', $storeId)
            ->where('role', 'owner')
            ->exists();
    }
}
