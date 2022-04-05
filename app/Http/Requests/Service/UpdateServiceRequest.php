<?php

namespace App\Http\Requests\Service;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('service.edit');
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
            'title' => ['required','max:255','unique:services,title,' . request()->route('service')->id],
            'category_id' => ['required'],
            'short_description' => ['nullable'],
            'long_description' => ['nullable'],
            'featured_image' => ['nullable','image'],
            'order' => ['required','url'],
            'preview' => ['required','url'],
            'envato' => ['required','url'],
        ];
    }
}
