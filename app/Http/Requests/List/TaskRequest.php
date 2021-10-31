<?php

namespace App\Http\Requests\List;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|unique:applist',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Task không được để trống',
            'status.required' => 'Tiến trình không được để trống',
            'name.unique' => 'Task này đã có',
        ];
    }
}
