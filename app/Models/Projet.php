<?php

namespace App\Models;
use App\Models\Tag;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

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
        'category_projet_id',
        'user_id',
        'slug',
        'start_date',
        'end_date',
        'type',
        'size',
        'author',
        'status',
    ];

    // BelongTo relation between projet and projet categorie
    public function category()
    {
        return $this->belongsTo(CategoryProjet::class, 'category_projet_id' , 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'isPublished');
    }

    public static function getSixLatestProjets(){
        return self::published()
        ->latest('created_at')
        ->take(12)
        ->get();
    }

    public static function getLastProjetsInCategory($categoryName)
    {
        return self::join('category_projets', 'projets.category_projet_id', '=', 'category_projets.id')
            ->where('category_projets.name', $categoryName)
            ->published()
            ->latest('projets.published_at')
            ->first();
    }

    public static function getSearchProjets($words, $categoryName = null){
        return self::query()
        ->leftJoin('category_projets', 'projets.category_projet_id', '=', 'category_projets.id')
        ->where(function ($query) use ($words) {
            $query->where('projets.title', 'like', '%' . $words . '%');
        })
        ->when($categoryName, function ($query, $categoryName) {
            return $query->where('category_projets.name', $categoryName);
        })
        ->paginate(6);
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
