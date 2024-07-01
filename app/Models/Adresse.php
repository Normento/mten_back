<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adresse extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'adresse',
        'email',
        'phone',
        'user_id',
        'status'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getLatestAdresse()
    {
        return self::orderBy('created_at', 'desc')->first();
    }


}
