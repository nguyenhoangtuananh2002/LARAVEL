<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Supports\Eloquent\Sluggable;
use App\Enums\post;
class userpost extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'posts';
    protected $guarded = [];
    protected $columnSlug = 'title';
    protected $casts = [
        'status' => post\userpost::class,
    ];

    public function isPublished()
    {
        return $this->status == post\userpost::Published;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id',
            'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', post\userpost::Published);
    }

    public function scopeHasCategories($query, array $categoriesId)
    {
        return $query->whereHas('categories', function ($query) use ($categoriesId) {
            $query->whereIn('id', $categoriesId);
        });
    }

    public function posts()
    {
        return $this->hasMany(userpost::class, 'id');
    }
}
