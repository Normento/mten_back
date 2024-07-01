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

class Organisme extends Model implements HasMedia
{
    use HasFactory , SoftDeletes, InteractsWithMedia;


    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'size',
        'views_count',
        'downloads_count',
        'created_date',
        'institution',
        'type',
        'dirigant',
        'slug'

    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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


}
