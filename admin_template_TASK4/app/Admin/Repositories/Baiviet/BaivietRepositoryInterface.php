<?php

namespace App\Admin\Repositories\Baiviet;
use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\userpost;

interface BaivietRepositoryInterface extends EloquentRepositoryInterface
{
    public function updateMultipleBy(array $filter = [], array $data);
    public function attachCategories(userpost $baiviet, array $danhmucId);

    public function syncCategories(userpost $baiviet, array $danhmucId);

}
