<?php

namespace App\Admin\Repositories\Post;
use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\userpost;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateMultipleBy(array $filter = [], array $data);
    public function attachCategories(userpost $post, array $categoriesId);
    public function attachTag(userpost $post, array $tagId);
    public function syncCategories(userpost $post, array $categoriesId);
    public function syncTag(userpost $post, array $tagId);
}
