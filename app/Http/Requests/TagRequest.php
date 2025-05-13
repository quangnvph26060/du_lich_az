<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'catalogue_id' => 'required|exists:catalogues,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->post?->id,
            'image' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'content' => 'required|string',
            'posted_at' => 'nullable|date',
            'remove_at' => 'nullable|date',
            'view_count' => 'required|string|max:255',
            'status' => 'required|boolean',
            'tags' => 'nullable|json',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'catalogue_id.required' => 'Danh mục không được để trống',
            'catalogue_id.exists' => 'Danh mục không tồn tại',
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.max' => 'Slug không được vượt quá 255 ký tự',
            'slug.unique' => 'Slug này đã tồn tại',
            'image.required' => 'Hình ảnh không được để trống',
            'image.max' => 'Đường dẫn hình ảnh không được vượt quá 255 ký tự',
            'short_description.max' => 'Mô tả ngắn không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'posted_at.date' => 'Ngày đăng không đúng định dạng',
            'remove_at.date' => 'Ngày xóa không đúng định dạng',
            'view_count.required' => 'Lượt xem không được để trống',
            'view_count.max' => 'Lượt xem không được vượt quá 255 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'tags.json' => 'Tags không đúng định dạng JSON',
            'seo_title.max' => 'SEO title không được vượt quá 255 ký tự',
        ];
    }
} 