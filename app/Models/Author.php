<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function journals()
    {
        return $this->belongsToMany(Journal::class, 'author_journal');
    }
}
