<?php

namespace App\Admin\Services\Danhmuc;
use App\Admin\Services\Blog\Category\Illuminate;
use Illuminate\Http\Request;

interface DanhmucServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     *
     * @var Illuminate\Http\Request $request
     *
     * @return boolean
     */
    public function update(Request $request, $id);
    /**
     * Xóa
     *
     * @param int $id
     *
     * @return boolean
     */
    public function delete($id);

}
