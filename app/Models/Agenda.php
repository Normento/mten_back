<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Ministre;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at','start_date','end_date',];

    protected $fillable = [
        'title',
        'description',
        'content',
        'location',
        'start_date',
        'end_date',
        'user_id',
        'status',
        'slug',
        'time',
        'type',
        'ministre_id',
        'category_agenda_id'
    ];


    public function category():BelongsTo
    {
        return $this->belongsTo(CategoryAgenda::class,'category_agenda_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ministre(): BelongsTo
    {
        return $this->belongsTo(Ministre::class);
    }

    public static function findninelatest()
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
