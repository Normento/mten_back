<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAgenda extends Model
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


    protected $table = 'category_agendas';

    public function agendas():HasMany
    {
        return $this->hasMany(Agenda::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
