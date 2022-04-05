<?php

namespace App\Http\Requests\Category;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('category.edit');
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
            'title'         => ['required','string'],
            'department_id' => ['required'],
            'parent_id'     => ['required'],
            'description'   => ['nullable'],
            'image'         => ['nullable','image'],
        ];
    }
}
