<?php

namespace App\Admin\Http\Controllers\Baiviet;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Baiviet\BaivietRequest;
use App\Admin\Repositories\Baiviet\BaivietRepositoryInterface;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Admin\Services\Baiviet\BaivietServiceInterface;
use App\Admin\DataTables\Baiviet\BaivietDataTable;
use App\Enums\Baiviet\Statuspost;
use Illuminate\Http\Request;

class BaivietController extends Controller
{
    protected $repoCat;

    protected $repoTag;

    public function __construct(
        BaivietRepositoryInterface $repository,
        DanhmucRepositoryInterface $repoCat,
        BaivietServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;
        $this->repoCat = $repoCat;
        $this->service = $service;
    }

    public function getView(){

        return [
            'index' => 'admin.Baiviet.Baidang.index',
            'create' => 'admin.Baiviet.Baidang.create',
            'edit' => 'admin.Baiviet.Baidang.edit'
        ];
    }

    public function getRoute(){

        return [
            'index' => 'admin.Baiviet.Baidang.index',
            'create' => 'admin.Baiviet.Baidang.create',
            'edit' => 'admin.Baiviet.Baidang.edit',
            'delete' => 'admin.Baiviet.Baidang.delete'
        ];
    }
    public function index(BaivietDataTable $dataTable){

        $actionMultiple = [
            'delete' => trans('delete'),
            'publishedStatus' => Statuspost::XuatBan->description(),
            'draftStatus' => Statuspost::Nhap->description()
        ];

        return $dataTable->render($this->view['index'], [
            'actionMultiple' => $actionMultiple,
            'breadcrums' => $this->crums->add(__('blog'))->add(__('post'))
        ]);
    }

    public function create(){

        $categories = $this->repoCat->getFlatTree();

        return view($this->view['create'], [
            'danhmuc' => $categories,
            'status' => Statuspost::asSelectArray(),
            'breadcrums' => $this->crums->add(__('Baiviet'))->add(__('Baidang'), route($this->route['index']))->add(__('add'))
        ]);
    }

    public function store(BaivietRequest $request){

        $response = $this->service->store($request);

        if($response){
            return $request->input('submitter') == 'save'
                    ? to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))
                    : to_route($this->route['index'])->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    /**
     * @throws \Exception
     */
    public function edit($id){

        // Retrieve all categories
        $categories = $this->repoCat->getFlatTree();

        // Fetch the Bai Viet post by ID
        $Baiviet = $this->repository->findOrFail($id, ['categories']);

        // Pass categories and Bai Viet post to the view
        return view(
            $this->view['edit'],
            [
                'categories' => $categories,
                'Baiviet' => $Baiviet,
                'status' => Statuspost::asSelectArray(),
                'breadcrums' => $this->crums->add(__('Baiviet'))->add(__('Baidang'), route($this->route['index']))->add(__('edit'))
            ],
        );
    }

    public function update(BaivietRequest $request, $id){

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

    public function actionMultipleRecode(Request $request){

        $response = $this->service->actionMultipleRecode($request);

        if($response){

            return $response;
        }

        return back()->with('error', __('notifyFail'));
    }
}
