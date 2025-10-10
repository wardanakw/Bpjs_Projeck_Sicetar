<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string', 
    ];

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKeuangan()
    {
        return $this->role === 'keuangan';
    }

    public function isFinance()
    {
        return $this->role === 'finance';
    }

    public function canAccess($permission) {
    $permissions = [
        'admin' => ['all'],
        'keuangan' => ['view', 'edit_koreksi'],
        'finance' => ['view', 'add_payment'],
    ];
    if (!isset($permissions[$this->role])) {
        return false;
    }
    return in_array('all', $permissions[$this->role]) || in_array($permission, $permissions[$this->role]);
}

}