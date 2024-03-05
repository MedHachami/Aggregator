<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table= 'comment';

    protected $fillable = [
        'content',
        'createdBy',
        'post_id',
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    use HasFactory;
}
