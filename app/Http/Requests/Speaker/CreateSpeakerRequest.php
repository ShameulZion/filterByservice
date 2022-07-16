<?php

namespace App\Http\Requests\Speaker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateSpeakerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('admin.testimonial.create');
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
            'name'          => ['required', 'string', 'max:255', 'unique:speakers'],
            'designation'   => ['required', 'string',],
            'facebook'      => ['nullable', 'url',],
            'twitter'       => ['nullable', 'url'],
            'linkedin'      => ['nullable','url'],
            'image'         => ['required','image'],
        ];
    }
}
