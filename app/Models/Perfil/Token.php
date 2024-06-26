<?php

namespace App\Models\Perfil;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Token extends Model
{
    protected $fillable = ['user_id', 'token', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function lastTokenHasExpired($userId)
    {
        $lastToken = self::where('user_id', $userId)
            ->latest('created_at')
            ->first();

        if ($lastToken) {
            return now()->gt($lastToken->expires_at);
        }

        return true;
    }

    public function hasExpired()
    {
        return now()->gt($this->expires_at);
    }
}
