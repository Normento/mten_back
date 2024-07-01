<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acteur extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia , SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sigle',
        'name',
        'url',
        'slug',
        'description',
        'content',
        'dirigant',
        'user_id',

    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
