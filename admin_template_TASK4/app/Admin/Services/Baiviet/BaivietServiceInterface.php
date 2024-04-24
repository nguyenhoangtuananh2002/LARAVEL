<?php

namespace App\Admin\Services\Baiviet;
use Illuminate\Http\Request;

interface BaivietServiceInterface
{
    public function store(Request $request);
    public function update(Request $request);
    public function delete($id);
    public function actionMultipleRecode(Request $request);
}
