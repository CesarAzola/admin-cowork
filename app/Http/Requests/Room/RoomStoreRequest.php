<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'description' => 'required|string|max:1000',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        // return [
        //     'name.required' => 'The room name is required.',
        //     'name.string' => 'The room name must be a string.',
        //     'name.max' => 'The room name may not be greater than 255 characters.',
            
        //     'description.required' => 'The description is required.',
        //     'description.string' => 'The description must be a string.',
        //     'description.max' => 'The description may not be greater than 1000 characters.',

        //     'photo.required' => 'The photo is required.',
        //     'photo.image' => 'The photo must be an image.',
        //     'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg.',
        //     'photo.max' => 'The photo may not be greater than 2MB.',
        // ];
    }
}
