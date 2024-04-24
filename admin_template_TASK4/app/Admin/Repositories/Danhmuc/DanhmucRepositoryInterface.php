<?php

namespace App\Admin\Repositories\Danhmuc;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface DanhmucRepositoryInterface extends EloquentRepositoryInterface
{
    public function getFlatTreeNotInNode(array $nodeId);

    public function getFlatTree();
}
