<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateTestimonialRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:testimonials'],
            'designation' => ['required', 'string',],
            'description' => ['required', 'string',],
            'company' => ['required', 'string', 'max:80'],
            'image' => ['required','image'],
        ];
    }
}
