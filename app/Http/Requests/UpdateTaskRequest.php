<?php

namespace App\Http\Requests;

use App\Enums\Priority;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'status' => [Rule::enum(Status::class)],
            'name' => ['string', 'max:255'],
            'description' => ['string'],
            'deadline' => ['date'],
            'priority' => ['string', Rule::enum(Priority::class)],
        ];
    }
}
