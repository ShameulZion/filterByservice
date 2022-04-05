<?php

namespace App\Http\Requests\Category;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('category.create');
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
            'title'         => ['required','string','max:255'],
            'department_id' => ['required'],
            'parent_id'     => ['required'],
            'description'   => ['nullable'],
            'image'         => ['nullable','image'],
        ];
    }
}
