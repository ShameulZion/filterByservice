<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('admin.news.create');
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
            'title' => ['required', 'string', 'max:255', 'unique:news,title,' . request()->route('news')->id],
            'blurb' => ['nullable', 'string',],
            'description' => ['nullable', 'string',],
            'meta_title' => ['required', 'string', 'max:100'],
            'meta_description' => ['nullable', 'string',],
            'meta_keyword' => ['nullable', 'string',],
            'video_url' => ['nullable', 'string',],
            'image' => ['nullable','image'],
        ];
    }
}
