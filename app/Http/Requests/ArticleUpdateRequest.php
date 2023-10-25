<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('Modifica Articolo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'string|required',
            'min_quantity' => 'numeric|min:1|required',
            'quantity' => 'numeric|min:1|required',
            'name' => 'string|required',
            'price' => 'numeric|min:1|required',
            'clusters' => 'json|required'
        ];
    }
}
