@extends('backend.layouts.master')

@php
    use App\Models\Tag;
    use App\Models\Keyword;
@endphp

@section('title', isset($blog) ? 'Sửa bài viết' : 'Thêm mới bài viết')
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-link mb-3" style="font-size:1.1rem;font-weight:500;">
            <i class="fa fa-arrow-left me-1"></i> Quay lại danh sách
        </a>
        <form action="{{ isset($blog) && $blog->id ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            @if (isset($blog) && $blog->id)
                @method('PUT')
            @endif

            <div class="row">
                <!-- Cột trái: Nội dung chính -->
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter post title"
                                    value="{{ old('title', $blog->title ?? '') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror" placeholder="Enter post slug"
                                    value="{{ old('slug', $blog->slug ?? '') }}">
                                <small class="text-muted">Preview: {{ url('/blog') }}/<span
                                        id="slug-preview">{{ old('slug', $blog->slug ?? '') }}</span></small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="short_description">Mô tả ngắn</label>
                                <input type="text" id="short_description" name="short_description"
                                    class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Enter post short description"
                                    value="{{ old('short_description', $blog->short_description ?? '') }}">
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">Nội dung</label>
                                <textarea id="content" name="content" class="form-control ckeditor @error('content') is-invalid @enderror"
                                    rows="8" placeholder="Enter content">{{ old('content', $blog->content ?? '') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Google Snippet Preview -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Preview trên Google</label>
                                <div id="google-snippet-preview"
                                    style="background:#fff;border:1px solid #e0e0e0;padding:16px 20px;border-radius:8px;max-width:700px;">
                                    <div id="gsp-title"
                                        style="color:#1a0dab;font-size:20px;line-height:1.2;font-weight:400;margin-bottom:2px;">
                                        {{ old('title', $blog->title ?? 'Tiêu đề bài viết') }}</div>
                                    <div id="gsp-url"
                                        style="color:#006621;font-size:14px;line-height:1.3;margin-bottom:2px;">
                                        {{ url('/blog') }}/<span
                                            id="gsp-slug">{{ old('slug', $blog->slug ?? 'slug-bai-viet') }}</span></div>
                                    <div id="gsp-desc" style="color:#545454;font-size:13px;line-height:1.4;">
                                        {{ old('short_description', $blog->short_description ?? 'Mô tả ngắn của bài viết sẽ hiển thị ở đây.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Card -->
                    <div class="card mb-3" id="seo-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">Tối ưu hóa tìm kiếm</h5>
                                <a href="#" id="edit-seo-btn">Edit SEO meta</a>
                            </div>
                            <div id="seo-desc">
                                <span>Setup meta title & description to make your site easy to discovered on search
                                    engines such as
                                    Google</span>
                            </div>
                            <div id="seo-form" style="display:none;">
                                <hr>
                                <!-- Phần hiển thị điểm SEO -->
                                <div class="mb-3">
                                    <h5 class="mb-0">SEO cơ bản <span class="badge bg-success ms-2">Tất cả điều tốt</span>
                                    </h5>
                                    <ul class="list-unstyled mb-0 mt-2">
                                        <li><i class="fa fa-check-circle text-success"></i> Tuyệt vời! Bạn đang sử dụng từ
                                            khoá chính trong Tiêu đề SEO.</li>
                                        <li><i class="fa fa-check-circle text-success"></i> Đã sử dụng từ khoá chính trong
                                            Mô tả Meta SEO.</li>
                                        <li><i class="fa fa-check-circle text-success"></i> Từ khoá chính đã được sử dụng
                                            trong URL.</li>
                                        <li><i class="fa fa-check-circle text-success"></i> Từ khoá chính xuất hiện trong
                                            10% nội dung đầu tiên.</li>
                                        <li><i class="fa fa-check-circle text-success"></i> Đã tìm thấy từ khoá chính trong
                                            nội dung.</li>
                                        <li><i class="fa fa-exclamation-circle text-warning"></i> Nội dung dài 1022 từ. Làm
                                            tốt lắm!</li>
                                    </ul>
                                </div>
                                <div class="alert alert-info mb-3" style="font-size: 0.95rem;">
                                    <i class="fa fa-info-circle"></i> Meta keywords was removed by Google, you don't
                                    need to add
                                    meta keywords to your website. Learn more: <a href="https://yoast.com/meta-keywords"
                                        target="_blank">https://yoast.com/meta-keywords</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hiển thị lỗi --}}
                    <div class="card mb-3" id="seo-card-error">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">Cẩn cải thiện<span class="badge bg-danger ms-2">2 Lỗi</span></h5>

                                <a href="#" id="edit-seo-btn-error">Edit SEO meta</a>
                            </div>
                            <div id="seo-desc-error"></div>
                            <div id="seo-form-error" style="display:none;">
                                <hr>
                                <!-- Phần hiển thị lỗi SEO -->
                                <div class="mb-3">
                                    <h5 class="mb-0">Bổ sung</h5>
                                    <ul class="list-unstyled mb-0 mt-2">
                                        <li><i class="fa fa-times-circle text-danger"></i> Tiêu đề chưa chứa từ khoá chính.
                                        </li>
                                        <li><i class="fa fa-times-circle text-danger"></i> Nội dung quá ngắn, cần tối thiểu
                                            300 từ.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thêm vào phần đầu form, sau phần nội dung chính -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="seoTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab"
                                        data-bs-target="#basic" type="button" role="tab">
                                        <i class="fas fa-info-circle"></i> SEO Cơ bản
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="seoTabsContent">
                                <!-- Tab SEO Cơ bản -->
                                <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- SEO Title -->
                                            <div class="form-group mb-3">
                                                <label for="seo_title" class="form-label">
                                                    SEO Title
                                                    <span class="text-muted" id="seo_title_counter">0/60</span>
                                                </label>
                                                <input type="text" class="form-control" id="seo_title"
                                                    name="seo_title"
                                                    value="{{ old('seo_title', $blog->seo_title ?? '') }}"
                                                    placeholder="Nhập tiêu đề SEO">
                                                <small class="text-muted">Tối ưu: 50-60 ký tự</small>
                                            </div>

                                            <!-- SEO Description -->
                                            <div class="form-group mb-3">
                                                <label for="seo_description" class="form-label">
                                                    SEO Description
                                                    <span class="text-muted" id="seo_description_counter">0/160</span>
                                                </label>
                                                <textarea class="form-control" id="seo_description" name="seo_description" rows="3"
                                                    placeholder="Nhập mô tả SEO">{{ old('seo_description', $blog->seo_description ?? '') }}</textarea>
                                                <small class="text-muted">Tối ưu: 120-160 ký tự</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Các khối chức năng -->
                <div class="col-lg-4">
                    <!-- Publish -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <h5 class="mb-0" style="font-weight:600;">Đăng bài</h5>
                            </div>
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100 mb-2"
                                    style="font-weight:600;">
                                    <i class="fa fa-save me-1"></i> Lưu
                                </button>
                                <button type="submit" class="btn btn-outline-secondary w-100" style="font-weight:600;">
                                    <i class="fa fa-sign-out-alt me-1"></i> Lưu & Thoát
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="status" class="mb-3">Trạng thái <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select">
                                <option value="1" {{ old('status', $blog->status ?? '') == 1 ? 'selected' : '' }}>
                                    Xuất bản</option>
                                <option value="0" {{ old('status', $blog->status ?? '') == 0 ? 'selected' : '' }}>
                                    Chưa xuất bản
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Catalogue -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="mb-2 fw-semibold">Catalogues <span class="text-danger">*</span></label>
                            <select class="form-select select2" name="catalogue_id" required>
                                <option value="">-- Chọn Catalogue --</option>
                                @foreach ($catalogues as $catalogue)
                                    <option value="{{ $catalogue->id }}"
                                        {{ old('catalogue_id', $blog->catalogue_id ?? '') == $catalogue->id ? 'selected' : '' }}>
                                        {{ $catalogue->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <!-- Image -->
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <label for="image" class="form-label">Ảnh</label>
                            <img class="img-fluid img-thumbnail w-100 mb-2" id="show_image" style="cursor: pointer"
                                src="{{ showImage($blog->image ?? '') }}" alt=""
                                onclick="document.getElementById('image').click();">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="file" name="image" id="image" class="form-control d-none"
                                accept="image/*" onchange="previewImage(event, 'show_image')">
                        </div>
                    </div>
                    <!-- Thời gian đăng/xóa -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="posted_at" class="form-label">Thời gian đăng bài</label>
                            <input type="datetime-local" id="posted_at" name="posted_at"
                                class="form-control @error('posted_at') is-invalid @enderror"
                                value="{{ old('posted_at', isset($blog->posted_at) ? date('Y-m-d\TH:i', strtotime($blog->posted_at)) : '') }}">
                            @error('posted_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label for="remove_at" class="form-label mt-3">Thời gian xóa bài</label>
                            <input type="datetime-local" id="remove_at" name="remove_at"
                                class="form-control @error('remove_at') is-invalid @enderror"
                                value="{{ old('remove_at', isset($blog->remove_at) ? date('Y-m-d\TH:i', strtotime($blog->remove_at)) : '') }}">
                            @error('remove_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Để trống nếu không muốn tự động xóa bài</small>
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="tags" class="mb-3">Tags <i
                                    class="fa-solid fa-tags tag-label-icon"></i></label>
                            <input type="text" id="tags" name="tags"
                                class="form-control @error('tags') is-invalid @enderror" placeholder="Enter tags"
                                value="{{ old('tags', isset($blog->blogTags) ? $blog->blogTags->pluck('name')->implode(',') : '') }}">
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Keyword --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="keywords" class="mb-3">Keywords <i
                                    class="fa-solid fa-key tag-label-icon"></i></label>
                            <input type="text" id="keywords" name="keywords"
                                class="form-control @error('keywords') is-invalid @enderror" placeholder="Enter keywords"
                                value="{{ old('keywords', isset($blog->keywords) ? $blog->keywords->pluck('name')->implode(',') : '') }}">
                            @error('keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .btn-lg {
            font-size: 1.1rem;
            padding: 12px 0;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .border-bottom {
            border-bottom: 1px solid #f0f0f0 !important;
        }

        .invalid-feedback {
            display: block;
        }

        #seo-card .form-group label {
            font-weight: 500;
        }

        #seo-card .alert-info {
            padding: 8px 12px;
        }

        #seo-card input[type="file"] {
            padding: 4px;
        }

        #edit-seo-btn {
            font-size: 1rem;
            color: #1976d2;
            text-decoration: none;
        }

        #edit-seo-btn:hover {
            text-decoration: underline;
        }

        .tag-label-icon {
            font-size: 1em;
            color: #8a99b3;
            margin-left: 6px;
            vertical-align: middle;
        }

        .catalogue-item {
            transition: all 0.3s ease;
        }

        .catalogue-item:hover {
            background-color: #f8f9fa;
        }

        #catalogue-search {
            border-right: none;
        }

        #catalogue-search:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .input-group-text {
            border-left: none;
        }

        #catalogue-list {
            max-height: 300px;
            overflow-y: auto;
        }

        #catalogue-list::-webkit-scrollbar {
            width: 6px;
        }

        #catalogue-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #catalogue-list::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        #catalogue-list::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const BASE_URL = "{{ url('/') }}";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder_php_3.7.0/ckfinder/ckfinder.js') }}"></script>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {

            $('.select2').select2({
                placeholder: "Chọn Catalogue",
                allowClear: true,
                width: '100%'
            });

            // Lấy giá trị old('tags') nếu có, ưu tiên khi validate lỗi
            var oldTags = @json(old('tags'));
            var tags = [];
            if (oldTags) {
                // Nếu oldTags là chuỗi, chuyển thành mảng
                if (typeof oldTags === 'string') {
                    tags = oldTags.split(',').map(function(item) {
                        return item.trim();
                    });
                } else if (Array.isArray(oldTags)) {
                    tags = oldTags;
                }
            } else {
                tags = @json(isset($blog->blogTags) ? $blog->blogTags->pluck('name')->toArray() : []);
            }
            var tagsInput = document.querySelector('#tags');
            var tagify = new Tagify(tagsInput, {
                whitelist: {!! json_encode(Tag::all()->pluck('name')) !!},
                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 1,
                    closeOnSelect: false,
                    position: "text",
                    searchKeys: ["value", "name"],
                    highlightFirst: true,
                    placeAbove: false
                }
            });

            // Nếu có tags cũ, thêm vào
            if (tags.length > 0) {
                tagify.addTags(tags);
            }

            // Xử lý keywords
            var keywordsInput = document.querySelector('#keywords');
            var keywords = {!! json_encode(isset($blog->keywords) ? $blog->keywords->pluck('name') : []) !!};
            var keywordify = new Tagify(keywordsInput, {
                whitelist: {!! json_encode(Keyword::all()->pluck('name')) !!},
                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "keywords-look",
                    enabled: 1,
                    closeOnSelect: false,
                    position: "text",
                    searchKeys: ["value", "name"],
                    highlightFirst: true,
                    placeAbove: false
                }
            });

            // Nếu có keywords cũ, thêm vào
            if (keywords.length > 0) {
                keywordify.addTags(keywords);
            }

            // Các xử lý khác
            $('#title').on('keyup', function() {
                var title = $(this).val();
                var slug = title.toLowerCase()
                    .replace(/[^a-z0-9-]/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
                $('#slug').val(slug);
                $('#slug-preview').text(slug);
            });

            $('#edit-seo-btn').on('click', function(e) {
                e.preventDefault();
                $('#seo-form').slideToggle(200);
                $('#seo-desc').slideToggle(200);
            });

            // Google Snippet Preview
            function updateSnippetPreview() {
                $('#gsp-title').text($('#title').val() || 'Tiêu đề bài viết');
                $('#gsp-slug').text($('#slug').val() || 'slug-bai-viet');
                $('#gsp-desc').text($('#short_description').val() || 'Mô tả ngắn của bài viết sẽ hiển thị ở đây.');
            }
            $('#title, #slug, #short_description').on('input', updateSnippetPreview);
            updateSnippetPreview();

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Xử lý radio button
            const radioButtons = document.querySelectorAll('input[name="catalogue_id"]');
            const checkedRadio = document.querySelector('input[name="catalogue_id"]:checked');

            if (!checkedRadio && radioButtons.length > 0) {
                radioButtons[0].checked = true;
            }

            // Xử lý form submit
            document.querySelector('form').addEventListener('submit', function(e) {
                const checkedRadio = document.querySelector('input[name="catalogue_id"]:checked');
                if (!checkedRadio) {
                    e.preventDefault();
                    alert('Vui lòng chọn một catalogue');
                }
            });
        });
    </script>

    <script>
        $('#edit-seo-btn-error').on('click', function(e) {
            e.preventDefault();
            $('#seo-form-error').slideToggle(200);
            $('#seo-desc-error').slideToggle(200);
        });
    </script>

    <!-- Script đếm ký tự và cập nhật preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Đếm ký tự SEO Title
            const seoTitle = document.getElementById('seo_title');
            const seoTitleCounter = document.getElementById('seo_title_counter');
            if (seoTitle) {
                seoTitle.addEventListener('input', function() {
                    seoTitleCounter.textContent = `${seoTitle.value.length}/60`;
                    document.getElementById('preview_title').textContent = seoTitle.value || 'Tiêu đề SEO';
                });
                seoTitleCounter.textContent = `${seoTitle.value.length}/60`;
            }

            // Đếm ký tự SEO Description
            const seoDescription = document.getElementById('seo_description');
            const seoDescriptionCounter = document.getElementById('seo_description_counter');
            if (seoDescription) {
                seoDescription.addEventListener('input', function() {
                    seoDescriptionCounter.textContent = `${seoDescription.value.length}/160`;
                    document.getElementById('preview_description').textContent = seoDescription.value ||
                        'Mô tả SEO';
                });
                seoDescriptionCounter.textContent = `${seoDescription.value.length}/160`;
            }
        });
    </script>
@endpush
