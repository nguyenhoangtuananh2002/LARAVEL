<?php

namespace App\Admin\DataTables\Danhmuc;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;

class DanhmucDataTable extends BaseDataTable
{

    protected $nameTable = 'DanhmucTable';

    public function __construct(
        DanhmucRepositoryInterface $repository
    ){
        $this->repository = $repository;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.Danhmuc.datatable.action',
            'name' => 'admin.Danhmuc.datatable.name',
            'status' => 'admin.Danhmuc.datatable.status',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [0];

        // $this->columnSearchSelect = [
        //     [
        //         'column' => 1,
        //         'data' => DefaultStatus::asSelectArray()
        //     ],
        // ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PostCategory $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function query()
    {
        $query = $this->repository->getFlatTree();
        return $query;
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.danhmuc', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'status' => $this->view['status'],
            'created_at' => '{{ format_date($created_at) }}'
        ];
    }

    protected function startBuilderDataTable($query){
        $this->instanceDataTable = datatables()->collection($query);
    }

    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['name', 'status', 'action'];
    }
}
