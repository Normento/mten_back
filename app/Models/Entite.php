<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entite extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'content',
        'user_id',
        'sigle',
        'dirigeant',
        'url',
        'slug',
    ];

    // BelongTo relation between projet and projet categorie


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'isPublished');
    // }

    public static function displayListeEntites(){
        return self::all();
    }

}
