<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email', 'password', 'first_name', 'last_name',
        'contact_no', 'birthday', 'role_id', 'created_by', 'updated_by'
    ];

    protected $hidden = ['password'];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function interests() {
        return $this->belongsToMany(Interest::class, 'client_interest');
    }

    public function clients() {
        return $this->hasMany(User::class, 'created_by');
    }
}
