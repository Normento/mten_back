<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'category_formation_id',
        'slug',
    ];

    // define belongto relation with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // define belongto relation with category
    public function category(){
        return $this->belongsTo(CategoryFormation::class, 'category_formation_id', 'id');
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
