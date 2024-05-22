<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class ArtistStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:m,f,o',
            'address' => 'required|string|max:255',
            'first_release_year' => 'required|integer|digits:4|date_format:Y',
            'no_of_album_released' => 'required|integer|min:0',
        ];
    }
}
