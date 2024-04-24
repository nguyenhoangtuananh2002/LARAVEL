<?php

namespace App\Admin\Repositories\Post;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Post\PostRepositoryInterface;
use App\Models\userpost;

class PostRepository extends EloquentRepository implements PostRepositoryInterface
{

    public function getModel()
    {
        return userpost::class;
    }

    public function updateMultipleBy(array $filter = [], array $data)
    {

        $this->instance = $this->model;

        $this->applyFilters($filter);

        $this->instance = $this->instance->update($data);
        return $this->instance;
    }

    public function attachCategories(userpost $post, array $categoriesId)
    {
        return $post->categories()->attach($categoriesId);
    }

    public function attachTag(userpost $post, array $tagId)
    {
        return $post->tags()->attach($tagId);
    }

    public function syncCategories(userpost $post, array $categoriesId)
    {
        return $post->categories()->sync($categoriesId);
    }

    public function syncTag(userpost $post, array $tagId)
    {
        return $post->tags()->sync($tagId);
    }
}
