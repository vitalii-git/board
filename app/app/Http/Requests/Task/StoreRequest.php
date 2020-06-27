<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'sometimes|string',
            'status_id' => 'required|exists:statuses,id',
            'board_id' => 'required|exists:boards,id',
            'labels' => 'sometimes|required|array|min:1',
            'labels.*' => 'exists:labels,id|distinct'
        ];
    }
}
