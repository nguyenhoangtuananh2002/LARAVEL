<?php

namespace App\Admin\Http\Requests\Baiviet;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Baiviet\Statuspost;
use Illuminate\Validation\Rules\Enum;

class BaivietRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'danhmuc_id' => ['required', 'array'],
            'danhmuc_id.*' => ['required', 'exists:App\Models\Danhmuc,id'],
            'title' => ['required', 'string'],
            'feature_image' => ['required'],
            'status' => ['required', new Enum(Statuspost::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Baiviet,id'],
            'danhmuc_id' => ['required', 'array'],
            'danhmuc_id.*' => ['required', 'exists:App\Models\Danhmuc,id'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:App\Models\Baiviet,slug,' . $this->id],
            'feature_image' => ['required'],
            'status' => ['required', new Enum(Statuspost::class)],
            'excerpt' => ['nullable'],
            'content' => ['nullable']
        ];
    }
}
