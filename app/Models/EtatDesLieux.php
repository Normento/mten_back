<?php

namespace App\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EtatDesLieux extends Model  implements HasMedia
{
    use HasFactory , InteractsWithMedia, SoftDeletes;

    protected $table = 'etats_des_lieux';

    protected $fillable = [
        'title',
        'description',
        'content',
        'size',
        'status',
        'views_count',
        'downloads_count',
        'type',
        'published_at',
        'user_id',
        'slug'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
