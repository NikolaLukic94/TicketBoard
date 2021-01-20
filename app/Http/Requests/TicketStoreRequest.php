<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'target_date' => ['required', 'date'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'urgency_level' => ['required', 'string'],
            'author_id' => ['required', 'integer', 'exists:users,id'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
        ];
    }
}
