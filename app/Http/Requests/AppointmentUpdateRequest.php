<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('Modifica Appuntamento');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id|required',
            'dateFrom' => 'date|required',
            'timeFrom' => 'required',
            'dateTo' => 'date|after_or_equal:dateFrom|required',
            'timeTo' => 'required',
            'title' => 'string|required'
        ];
    }
}
