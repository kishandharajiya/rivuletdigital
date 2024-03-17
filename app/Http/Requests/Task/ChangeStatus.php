<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatus extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
             'status'=> 'in:To Do,In Progress,Done,Closed',
        ];
    }
}
