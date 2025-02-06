<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Journal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class,'user-id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_journal', );
    }
}
