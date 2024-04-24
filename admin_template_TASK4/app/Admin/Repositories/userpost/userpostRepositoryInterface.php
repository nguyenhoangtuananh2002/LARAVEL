<?php
namespace App\Admin\Repositories\userpost;
use App\Admin\Repositories\EloquentStandardRepositoryInterface;
interface userpostRepositoryInterface extends EloquentStandardRepositoryInterface
{
    public function findBy(array $filter, array $relations = []);
    public function getByLimit(array $filter, array $filterRelation = [], array
                                     $relations = [], int $limit = 10, array $sort = ['id', 'asc']);
    public function paginate(array $filter, array $relationCondition = [], array
                                   $relations = [], int $paginate = 10);
}
