<?php

namespace App\Models;

use App\Models\User;
use App\Models\Actualite;
use App\Models\Organisme;
use App\Models\Ecosysteme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tags";

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actualites()
    {
        return $this->morphedByMany(Actualite::class, 'taggable');
    }

     public function documents()
    {
        return $this->morphedByMany(Document::class, 'taggable');
    }

     public function agendas()
    {
        return $this->morphedByMany(Agenda::class, 'taggable');
    }

    public function opportunites()
    {
        return $this->morphedByMany(Opportunite::class, 'taggable');
    }

    public function reformes()
    {
        return $this->morphedByMany(Reforme::class, 'taggable');
    }

    public function formations()
    {
        return $this->morphedByMany(Formation::class, 'taggable');
    }

    public function startups()
    {
        return $this->morphedByMany(Startup::class, 'taggable');
    }


    public function rapports()
    {
        return $this->morphedByMany(Rapport::class, 'taggable');
    }

    public function projet()
    {
        return $this->morphedByMany(Projet::class, 'taggable');
    }

    public function ecosysteme()
    {
        return $this->morphedByMany(Ecosysteme::class, 'taggable');
    }

     public function organisme()
    {
        return $this->morphedByMany(Organisme::class, 'taggable');
    }


}
