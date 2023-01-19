<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidEndDate;

class EventStoreRequest extends FormRequest
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
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Event name is required',
            'end_date.after' => 'Event end date must be a date after start date',
        ];
    }
}
