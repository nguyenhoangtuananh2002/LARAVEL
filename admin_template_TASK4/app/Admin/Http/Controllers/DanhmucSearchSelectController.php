<?php
namespace App\Admin\Http\Controllers;
use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Admin\Http\Resources\Danhmuc\DanhmucSearchSelectResource;
class DanhmucSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        DanhmucRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }
    protected function selectResponse(){
        $this->instance = [
            'results' => DanhmucSearchSelectResource::collection($this->instance)
        ];
    }
}
