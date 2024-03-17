<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'status'=> 'in:To Do,In Progress,Done,Closed',
            'due_date' => 'required|date'
        ];
    }
}
