<?php

namespace App\Http\Requests;

use App\Enums\Priority;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::enum(Status::class)],
            'priority' => ['required', Rule::enum(Priority::class)],
            'deadline' => ['date'],
            'user_id' => ['sometimes', 'exists:users,id'],
        ];
    }
}
