<?php

namespace App\Admin\Repositories\Baiviet;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Baiviet\BaivietRepositoryInterface;
use App\Models\userpost;

class BaivietRepository extends EloquentRepository implements BaivietRepositoryInterface
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

    public function attachCategories(userpost $baiviet, array $danhmucId)
    {
        return $baiviet->categories()->attach($danhmucId);
    }



    public function syncCategories(userpost $baiviet, array $danhmucId)
    {
        return $baiviet->categories()->sync($danhmucId);
    }


}
