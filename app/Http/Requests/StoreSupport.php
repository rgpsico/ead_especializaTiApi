<?php

namespace App\Http\Requests;

use App\Models\Support;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupport extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Support $support)
    {

        return [
            'lesson' => ['required', 'exitsts:lessons,id'],
            'status' => [
                'required', Rule::in([array_keys($support->statusOptions)])
            ],

            'description' => ['required', 'min:3', 'max:10000']
        ];
    }
}
