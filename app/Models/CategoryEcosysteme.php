<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ecosysteme;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryEcosysteme extends Model implements HasMedia
{
    use HasFactory , SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function ecosystemes()
    {
        return $this->hasMany(Ecosysteme::class, 'category_ecosysteme_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
