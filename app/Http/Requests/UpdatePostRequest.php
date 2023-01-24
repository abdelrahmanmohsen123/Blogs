<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|regex:/^[a-zA-Z ]+$/',
            'image' => 'image|max:2000000|mimes:jpg,png,webp' ,
            'content' => 'required|min:20',
            'author' =>'nullable',
            'date' =>'date'
            ];
    }
}
