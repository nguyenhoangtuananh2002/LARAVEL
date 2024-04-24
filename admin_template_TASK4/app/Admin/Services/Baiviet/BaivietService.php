<?php

namespace App\Admin\Services\Baiviet;

use App\Admin\Services\Baiviet\BaivietServiceInterface;
use  App\Admin\Repositories\Baiviet\BaivietRepositoryInterface;
use App\Enums\Baiviet\Statuspost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaivietService implements BaivietServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(BaivietRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();
        $this->data['posted_at'] = now();
        $categoriesId = $this->data['danhmuc_id'];

        unset($this->data['danhmuc_id']);

        DB::beginTransaction();
        try {
            $baiviet = $this->repository->create($this->data);

            $this->repository->attachCategories($baiviet, $categoriesId);


            DB::commit();
            return $baiviet;
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request){

        $this->data = $request->validated();

        $categoriesId = $this->data['danhmuc_id'];

        unset($this->data['danhmuc_id']);

        DB::beginTransaction();
        try {
            $baiviet = $this->repository->update($this->data['id'], $this->data);

            $this->repository->syncCategories($baiviet, $categoriesId);


            DB::commit();
            return $baiviet;
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return false;
        }
    }

    public function delete($id){

        return $this->repository->delete($id);
    }

    public function actionMultipleRecode(Request $request){

        if(!$request->input('id') || empty($request->input('id'))){
            return false;
        }

        $data = $request->all();

        if($data['action'] == 'delete'){

            foreach($data['id'] as $id){

                $this->delete($id);
            }

            return back()->with('success', __('notifySuccess'));
        }elseif($data['action'] == 'XuatBanStatus' || $data['action'] == 'NhapStatus'){

            $this->repository->updateMultipleBy([
                ['id', 'in', $data['id']]
            ], [
                'status' => $data['action'] == 'XuatBanStatus' ? Statuspost::XuatBan : Statuspost::Nhap
            ]);

            return back()->with('success', __('notifySuccess'));
        }

        return false;
    }
}
