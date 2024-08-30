<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['user_id', 'image', 'title', 'slug', 'content', 'published_at', 'featured'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class,'post_like')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(comments::class);
    }


    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }
    public function scopeShowCategory($query, string $Category)
    {
        // dd($Category);
        $query->whereHas('Category', function ($query) use ($Category) {
            $query->where('slug', $Category);
        });
    }

    public function getExpert()
    {
        return Str::limit($this->content, 150, '...');
    }
    public function getReadingTime()
    {
        $min = round(str_word_count($this->content) / 250);
        return $min < 1 ? 1 : $min;
    }

    public function getThumbnailUrl()
    {
        // Check if the image path contains 'http', indicating it's already a URL
        $isUrl = str_contains($this->image, 'http');

        // Return the image as is if it's a URL, otherwise get the URL from the public storage disk
        return $isUrl ? $this->image : Storage::disk('public')->url($this->image);
    }
}
