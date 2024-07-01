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

class Actualite extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia , SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'title',
        'description',
        'content',
        'category_actualite_id',
        'user_id',
        'status',
        'slug',

    ];

    protected $table = 'actualites';


    public function category():BelongsTo
    {
        return $this->belongsTo(CategoryActualite::class,'category_actualite_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'isPublished');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function getTwoLatest()
    {
        return self::where('status', 'isPublished')->orderBy('created_at', 'desc')->limit(2)->get();

    }

    public static function getThreeLatest()
    {
        return self::where('status', 'isPublished')->orderBy('created_at', 'desc')->limit(3)->get();

    }

    public static function getNineLatest()
    {
        return self::where('status', 'isPublished')->orderBy('created_at', 'desc')->limit(9)->get();

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
