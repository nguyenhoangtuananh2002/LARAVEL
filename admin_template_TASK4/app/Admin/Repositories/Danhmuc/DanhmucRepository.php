<?php

namespace App\Admin\Repositories\Danhmuc;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Models\Danhmuc;

class DanhmucRepository extends EloquentRepository implements DanhmucRepositoryInterface
{
    public function getModel()
    {
        return Danhmuc::class;
    }


    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getFlatTreeNotInNode(array $nodeId)
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->whereNotIn('id', $nodeId)
            ->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;
    }
    public function getFlatTree()
    {
        $this->getQueryBuilderOrderBy('position', 'ASC');
        $this->instance = $this->instance->withDepth()
            ->get()
            ->toFlatTree();
        return $this->instance;

    }

}
