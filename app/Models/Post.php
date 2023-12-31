<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'content',
        'thumbnail'
    ];

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
