<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location'=>'required|max:100',
            'response'=>'required|in:0,1',
            'body'=>'required|max:1000',
            'before_image'=>'nullable|image|max:1024',
            'counterplan'=>'exclude_unless:response,0|required|max:1000',
            'after_image'=>'nullable|image|max:1024'
        ];
    }
}
