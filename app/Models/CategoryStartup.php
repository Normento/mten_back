<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryStartup extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];


        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $fillable = [
        'name',
        'user_id',
        'description'

    ];


    protected $table = 'category_startups';

    public function startups():HasMany
    {
        return $this->hasMany(Startup::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
