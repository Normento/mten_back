<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\CategoryRapport;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapport extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'content',
        'category_rapport_id',
        'user_id',
        'status',
        'views_count',
        'downloads_count',
        'secteur_activite',
        'type_activite',
        'institution',
        'start_date',
        'end_date',
        'size',
        'type',
        'slug',
    ];




    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function attachTags($tags)
    {
        foreach ($tags as $tagTitle) {
            $tag = Tag::firstOrCreate(['title' => $tagTitle]);
            $this->tags()->syncWithoutDetaching($tag->id);
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryRapport::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopePublished($query)
    {
        return $query->where('status', 'isPublished');
    }

    public static function getListesRapport(){
        return self::Published()
        ->get();
    }
}
