<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Supports\Eloquent\Sluggable;
use App\Enums\Baiviet\Statuspost;

class Baiviet extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'baiviet';
    protected $guarded = [];
    protected $columnSlug = 'title';

    protected $casts = [
        'status' => Statuspost::class,
    ];

    public function isPublished(){
        return $this->status == Statuspost::XuatBan;
    }

    public function danhmuc(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Danhmuc::class, 'baiviet_danhmuc', 'baiviet_id', 'danhmuc_id');
    }


    public function scopePublished($query){
        return $query->where('status', Statuspost::XuatBan);
    }

    public function scopeHasCategories($query, array $categoriesId){
        return $query->whereHas('categories', function($query) use($categoriesId) {
            $query->whereIn('id', $categoriesId);
        });
    }
}
