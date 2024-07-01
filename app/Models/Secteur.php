<?php

namespace App\Models;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Secteur extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'url',
        'content',
        'user_id',
        

    ];

    // BelongTo relation between projet and projet categorie


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'publish');
    // }



}
