<?php

namespace App\Admin\Services\Danhmuc;

use App\Admin\Services\Danhmuc\DanhmucServiceInterface;
use  App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use Illuminate\Http\Request;

class DanhmucService implements DanhmucServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(DanhmucRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();

        return $this->repository->create($this->data);
    }

    public function update(Request $request, $id){

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}
