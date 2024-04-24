<?php

namespace App\Admin\DataTables\Baiviet;

use App\Admin\DataTables\BaseDataTable;
use App\Admin\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Admin\Repositories\Baiviet\BaivietRepositoryInterface;
use App\Enums\Baiviet\Statuspost;

class BaivietDataTable extends BaseDataTable
{

    protected $nameTable = 'BaivietTable';

    protected $repoCat;

    public function __construct(
        BaivietRepositoryInterface $repository,
        DanhmucRepositoryInterface $repoCat
    ){
        $this->repository = $repository;

        $this->repoCat = $repoCat;

        parent::__construct();
    }

    public function setView(){
        $this->view = [
            'action' => 'admin.Baiviet.datatable.action',
            'feature_image' => 'admin.Baiviet.datatable.feature-image',
            'title' => 'admin.Baiviet.datatable.title',
            'status' => 'admin.Baiviet.datatable.status',
            'danhmuc' => 'admin.Baiviet.datatable.danhmuc',
            'checkbox' => 'admin.Baiviet.datatable.checkbox',
        ];
    }

    public function setColumnSearch(){

        $this->columnAllSearch = [2, 3, 4, 5];

        $this->columnSearchDate = [5];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => Statuspost::asSelectArray()
            ],
        ];

        $this->columnSearchSelect2 = [
            [
                'column' => 4,
                'data' => $this->repoCat->getFlatTree()->map(function($danhmuc){
                    return [$danhmuc->id => generate_text_depth_tree($danhmuc->depth).$danhmuc->name];
                })
            ]
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->repository->getByQueryBuilder([], ['danhmuc']);
    }

    protected function setCustomColumns(){
        $this->customColumns = config('datatables_columns.Baiviet', []);
    }

    protected function setCustomEditColumns(){
        $this->customEditColumns = [
            'feature_image' => $this->view['feature_image'],
            'title' => $this->view['title'],
            'status' => $this->view['status'],
            'danhmuc' => $this->view['danhmuc'],
            'created_at' => '{{ format_date($created_at) }}',
            'checkbox' => $this->view['checkbox'],
        ];
    }
    protected function setCustomFilterColumns()
    {
        $this->customFilterColumns = [
            'categories' => function($query, $keyword) {
                $query->whereHas('danhmuc', function($q) use($keyword) {
                    $q->whereIn('id', explode(',', $keyword));
                });
            }
        ];
    }
    protected function setCustomAddColumns(){
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(){
        $this->customRawColumns = ['checkbox', 'feature_image', 'title', 'status', 'danhmuc', 'action'];
    }
}
