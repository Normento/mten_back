<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'slug'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
