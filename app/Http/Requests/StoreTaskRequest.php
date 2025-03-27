<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', new Enum(TaskStatus::class)],
            'priority' => ['required', new Enum(TaskPriority::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Başlık alanı zorunludur.',
            'title.string' => 'Başlık alanı metin olmalıdır.',
            'title.max' => 'Başlık alanı en fazla 255 karakter olmalıdır.',
            'description.string' => 'Açıklama alanı metin olmalıdır.',
            'status.required' => 'Durum alanı zorunludur.',
            'priority.required' => 'Öncelik alanı zorunludur.',
            'status.enum' => 'Geçersiz durum seçildi.',
            'priority.enum' => 'Geçersiz öncelik seçildi.',
        ];
    }
}
