<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContacts extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return ['contacts' => 'required|mimes:csv,txt'];
    }

    /**
     * Get rules error message
     *
     * @return array
     */
    public function messages() {
        return [
            'contacts.required' => "File is required",
            'contacts.mimes' => "File must be CSV file",
        ];
    }
}
