<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\CategoryDocument;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    // define filable column
    protected $fillable = [
        'name',  
        'description', 
        'content', 
        'category_document_id',
        'user_id',
        'views_count',
        'downloads_count',
        'size',
        'slug',
        'status',
    ];

    // define belongto relation
    public function category(){
        return $this->belongsTo(CategoryDocument::class, 'category_document_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public static function getTenLatestDocument(){

        $categoriesToExclude = ['lois', 'decrets', 'aretes','observatoire'];

        $categoryIdsToExclude = CategoryDocument::whereIn('slug', $categoriesToExclude)->pluck('id')->toArray();

       return self::whereNotIn('category_document_id', $categoryIdsToExclude)
            ->latest('created_at')
            ->where('status', 'isPublished')
            ->take(10)
            ->get();
    }

    public static function getSearchDocument($words, $categoryName){
        return self::query()
        ->leftJoin('category_documents', 'documents.category_document_id', '=', 'category_documents.id')
        ->where(function ($query) use ($words) {
            $query->where('documents.title', 'like', '%' . $words . '%');
        })
        ->when($categoryName, function ($query, $categoryName) {
            return $query->where('category_documents.name', $categoryName);
        })
        ->paginate(12);
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
