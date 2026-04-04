<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->page ? $this->page->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $id,
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'seo_title' => 'nullable|string|max:70',
            'seo_description' => 'nullable|string|max:160'
        ];
    }
}
