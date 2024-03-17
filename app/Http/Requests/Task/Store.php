<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date'
        ];
    }
}
