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

class Reforme extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia, SoftDeletes;

    protected $table = 'reformes';

    protected $fillable = [
        'title',
        'description',
        'author',
        'content',
        'slug',
        'views_count',
        'downloads_count',
        'size',
        'type',
        'status',
        'user_id',

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


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopePublished($query)
    {
        return $query->where('status', 'isPublished');
    }

    public static function getLatestReforme(){
        return self::Published()
        ->paginate(10);
    }
}





