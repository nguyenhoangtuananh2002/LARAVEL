<?php

namespace App\Models;

use App\Enums\Baiviet\Statuspost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Supports\Eloquent\Sluggable;

class Danhmuc extends Model
{
    use HasFactory, NodeTrait, Sluggable;

    protected $table = 'danhmuc';

    protected $guarded = [];

    protected $casts = [
        'status' => Statuspost::class
    ];

    public function posts(){
        return $this->belongsToMany(userpost::class, 'danhmuc_baiviet', 'danhmuc_id', 'baiviet_id');
    }

    public function scopePublished($query){
        return $query->where('status', Statuspost::XuatBan);
    }
}
