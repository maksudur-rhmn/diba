<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskPostRequest extends FormRequest
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
            'tasks'            => 'required',
            'task_description' => 'required',
            'deadline'         => 'required',
            'roles'            => 'required_without:user_id',
            'user_id'          => 'required_without:roles',
        ];
    }
}
