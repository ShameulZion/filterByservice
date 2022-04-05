<?php

namespace App\Http\Requests\Service;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('service.create');
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
            'title' => ['required','unique:services','max:255'],
            'category_id' => ['required'],
            'short_description' => ['nullable'],
            'long_description' => ['nullable'],
            'featured_image' => ['required','image'],
            'order' => ['required','url'],
            'preview' => ['required','url'],
            'envato' => ['required','url'],
        ];
    }
}
