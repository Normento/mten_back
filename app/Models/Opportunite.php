<?php

namespace App\Models;

use App\Models\Tag;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opportunite extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'content',
        'category_opportunity_id',
        'user_id',
        'structure_acceuil',
        'views_count',
        'downloads_count',
        'size',
        'status',
        'slug',
    ];

    protected $table = 'opportunites';

    public function category()
        {
            return $this->belongsTo(CategoryOpportunity::class, 'category_opportunity_id' , 'id');
        }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopePublished($query)
    {
         return $query->where('status', 'isOpenned');
    }

    public static function displayListesOpportunities(){
        return self::Published()
            ->paginate(9);

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
