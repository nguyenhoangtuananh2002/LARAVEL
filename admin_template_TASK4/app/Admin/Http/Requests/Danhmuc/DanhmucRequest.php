<?php

namespace App\Admin\Http\Requests\Danhmuc;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Baiviet\Statuspost;
use App\Admin\Rules\Category\CategoryParent;
use Illuminate\Validation\Rules\Enum;

class DanhmucRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:App\Models\Danhmuc,id'],
            'position' => ['required', 'integer'],
            'status' => ['required', new Enum(Statuspost::class)]
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['nullable', 'exists:App\Models\Danhmuc,id'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:App\Models\Danhmuc,slug,'.$this->id],
            'parent_id' => ['nullable', 'exists:App\Models\Danhmuc,id', new CategoryParent($this->id)],
            'position' => ['nullable', 'integer'],
            'status' => ['required', new Enum(Statuspost::class)]
        ];
    }
}
