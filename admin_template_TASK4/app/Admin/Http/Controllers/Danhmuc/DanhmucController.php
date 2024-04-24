<?php

namespace App\Admin\Http\Controllers\Danhmuc;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Danhmuc\DanhmucRequest;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Admin\Services\Danhmuc\DanhmucServiceInterface;
use App\Admin\DataTables\Danhmuc\DanhmucDataTable;
use App\Enums\Baiviet\Statuspost;

class DanhmucController extends Controller
{
    public function __construct(
        DanhmucRepositoryInterface $repository,
        DanhmucServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'admin.Baiviet.Danhmuc.index',
            'create' => 'admin.Baiviet.Danhmuc.create',
            'edit' => 'admin.Baiviet.Danhmuc.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'admin.Baiviet.Danhmuc.index',
            'create' => 'admin.Baiviet.Danhmuc.create',
            'edit' => 'admin.Baiviet.Danhmuc.edit',
            'delete' => 'admin.Baiviet.Danhmuc.delete'
        ];
    }
    public function index(DanhmucDataTable $dataTable){

        return $dataTable->render($this->view['index'], [
            'breadcrums' => $this->crums->add(__('Baiviet'))->add(__('Danhmuc'))
        ]);
    }

    public function create(){

        $danhmuc = $this->repository->getFlatTree();

        return view($this->view['create'], [
            'danhmuc' => $danhmuc,
            'status' => Statuspost::asSelectArray(),
            'breadcrums' => $this->crums->add(__('Baiviet'))->add(__('Baidang'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(DanhmucRequest $request){

        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $category = $this->repository->getById($id);
        $categories = $this->repository->getFlatTreeNotInNode([$id]);

        return view(
            $this->view['edit'],
            [
                'category' => $category,
                'categories' => $categories,
                'status' => Statuspost::asSelectArray(),
                'breadcrums' => $this->crums->add(__('Baiviet'))->add(__('danhmuc'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }


    public function update(DanhmucRequest $request, $id){


        $response = $this->service->update($request, $id);

        if($response){
            return $request->input('submitter') == 'save'
                    ? back()->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'));
    }

    public function delete($id){

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
