<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:blogs,slug,' . ($this->blog ? $this->blog->id : ''),
            'content' => 'required',
            'status' => 'required|in:0,1',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'keywords' => 'nullable|array',
            'keywords.*' => 'string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug này đã tồn tại',
            'content.required' => 'Vui lòng nhập nội dung bài viết',
            'status.required' => 'Vui lòng chọn trạng thái',
            'tags.*.max' => 'Tag không được vượt quá 50 ký tự',
            'keywords.*.max' => 'Keyword không được vượt quá 50 ký tự',
        ];
    }
} 