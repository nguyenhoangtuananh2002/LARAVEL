<?php

namespace App\Admin\Http\Controllers\userpost;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\userpost\userpostRepository;
use App\Admin\Repositories\userpost\userpostRepositoryInterface;
use App\Admin\Repositories\Category\CategoryRepositoryInterface;

class UserPostController extends Controller
{
    protected $repoPost;
    protected $repoCat;

    public function __construct(
        userpostRepositoryInterface     $repoPost,
        CategoryRepositoryInterface $repoCat,
    )
    {
        parent::__construct();
        $this->repoPost = $repoPost;
        $this->repoCat = $repoCat;
    }

    public function getView()
    {
        return [
            'index' => 'Public.layouts.index',
            'detail' => 'Public.layouts.chitietbaiviet',
            'cate' => 'public.posts.post-by-cate',
        ];
    }

    public function getRoute()
    {
        return [];
    }

    public function index()
    {
        $posts = $this->repoPost->paginate([], [], []);
        $breadcrums = [['label' => trans('Tin tức')]];
        return view($this->view['index'], [
            'userpost' => $posts,
            'breadcrums' => $breadcrums,
        ]);

    }

    public function showPost($slug)
    {
        $posts = $this->repoPost->findByOrFail(['slug' => $slug], ['posts',
            'categories']);
        $breadcrums = [
            ['label' => $posts->title]
        ];
        $related = $this->repoPost->getByLimit([
            ['id', '!=', $posts->id]
        ], [
            'categories' => fn($q) => $q->whereIn('id', $posts->categories ->pluck('id')->toArray())
], [], 5);
return view($this->view['detail'], [
    'userpost' => $posts,
    'related' => $related,
    'breadcrums' => $breadcrums,
]);
}
}

