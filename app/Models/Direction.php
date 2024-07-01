<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\CategoryDirection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direction extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'sigle',
        'slug',
        'director_name',
        'category_direction_id',
        'user_id',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function getForLatest()
    {
        return self::orderBy('created_at', 'desc')->limit(4)->get();

    }

    public function category(){
        return $this->belongsTo(CategoryDirection::class);
    }


}
