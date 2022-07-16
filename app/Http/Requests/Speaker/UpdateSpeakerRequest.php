<?php

namespace App\Http\Requests\Speaker;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeakerRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:255', 'unique:speakers,name,' . request()->route('speaker')->id],
            'designation'   => ['required', 'string',],
            'facebook'      => ['nullable', 'url',],
            'twitter'       => ['nullable', 'url'],
            'linkedin'      => ['nullable','url'],
            'image'         => ['nullable','image'],
        ];
    }
}
