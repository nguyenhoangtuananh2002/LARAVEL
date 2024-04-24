<?php

namespace App\Admin\Repositories\userpost;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\userpost\userpostRepositoryInterface;
use App\Models\userpost;

class userpostRepository extends EloquentRepository implements \App\Admin\Repositories\userpost\userpostRepositoryInterface
{

    public function getModel()
    {
        return userpost::class;
    }

    public function findBy(array $filter, array $relations = [])
    {
        $this->instance = $this->model;
        $this->applyFilters($filter);
        $this->instance = $this->instance->with($relations)->first();
        return $this->instance;
    }
    public function paginate(array $filter, array $relationCondition = [], array
                                   $relations = [], int $paginate = 10)
    {
        $this->getQueryBuilder();
        $this->applyFilters($filter);
        foreach($relationCondition as $relation => $condition){
            $this->instance = $this->instance->whereHas($relation, $condition);
        }
        return $this->instance->published()->with($relations)->paginate($paginate);
}
    public function getByLimit(array $filter, array $filterRelation = [], array
                                     $relations = [], int $limit = 10, array $sort = ['id', 'desc'])
    {
        $this->getQueryBuilder();
        $this->applyFilters($filter);
        foreach ($filterRelation as $relation => $condition) {
            $this->instance = $this->instance->whereHas($relation, $condition);
        }
        return $this->instance->published()->with($relations)->limit($limit)->orderBy(...$sort)->get();
}
}
