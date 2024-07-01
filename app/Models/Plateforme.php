<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use App\Models\CategoryPlateforme;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plateforme extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;


    protected $fillable = [
        'name', 
        'description',
        'content',
        'status',
        'user_id'

    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'isPublished');
    // }

    public static function getFourLatestPlateformes(){
        return self::latest('created_at')
        ->take(4)
        ->get();
    }
}
