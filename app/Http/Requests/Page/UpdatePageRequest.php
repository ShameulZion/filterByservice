<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:pages,title,' . request()->route('page')->id],
            'description' => ['nullable', 'string',],
            'meta_title' => ['required', 'string', 'max:80'],
            'meta_description' => ['nullable', 'string',],
            'meta_keyword' => ['nullable', 'string',],
            'sort_order' => ['nullable', 'numeric',],
            'parent_id' => ['nullable', 'string',],
            'image' => ['nullable'],
        ];
    }
}
