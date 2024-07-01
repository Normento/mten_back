<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\CategoryEcosysteme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ecosysteme extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description', 
        'content',
        'user_id',
        'category_ecosysteme_id',

    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryEcosysteme::class);
    }

    public function attachTags($tags)
    {
        foreach ($tags as $tagTitle) {
            $tag = Tag::firstOrCreate(['title' => $tagTitle]);
            $this->tags()->syncWithoutDetaching($tag->id);
        }
    }
}
