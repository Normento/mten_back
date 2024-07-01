<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mission extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title','description','content','user_id','status',
        'published_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function getLatest()
    {
        return self::where('status', 'isPublished')->orderBy('created_at', 'desc')->first();

    }
}


