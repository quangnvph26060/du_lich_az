@extends('backend.layouts.master')
@section('title', 'Danh sách bài viết')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách bài viết</h4>
            <div class="card-tools">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">Thêm mới bài viết (+)</a>
                <button onclick="window.location.reload()" class="btn btn-info btn-sm ms-2">
                    <i class="fa-solid fa-rotate"></i> Tải lại
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll" /></th>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Catalogues</th>
                            <th>Ngày tạo</th>
                            <th>Lượt xem</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td class="text-center"><input type="checkbox" class="blog-checkbox" /></td>
                                <td class="text-center">{{ $blog->id }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="img-thumbnail">
                                </td>
                                <td class="text-left">{{ $blog->title }}</td>
                                <td class="text-left">{{ $blog->catalogue->name }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($blog->posted_at)->format('d/m/Y') }}</td>
                                <td class="text-center">{{ number_format($blog->view_count) }}</td>
                                <td class="text-center">
                                    @if ($blog->status == 1)
                                        <span class="badge bg-success">Đã xuất bản</span>
                                    @else
                                        <span class="badge bg-warning">Chưa xuất bản</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-blog" data-id="{{ $blog->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <style>
        .table th,
        .table td {
            vertical-align: middle !important;
            text-align: center;
            padding: 8px 6px;
            font-size: 13px;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .table td.text-left {
            text-align: left !important;
        }

        .img-thumbnail {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin: 0 auto;
        }

        .badge {
            padding: 4px 10px;
            font-size: 11px;
            border-radius: 10px;
            font-weight: 500;
        }

        .btn-sm {
            padding: 0.12rem 0.32rem;
            margin: 0 3px;
            border-radius: 7px;
            font-size: 11px;
            min-width: 26px;
            min-height: 26px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        #myTable th,
        #myTable td {
            padding: 8px 6px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json"
                },
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tất cả"]],
                "ordering": true,
                "searching": true,
                "responsive": true,
                "order": [[1, 'desc']],
                "columnDefs": [{
                    "targets": [0, 8], // Cột checkbox và action
                    "orderable": false
                }]
            });

            // Xử lý checkbox select all
            $('#selectAll').on('click', function() {
                $('.blog-checkbox').prop('checked', $(this).prop('checked'));
            });

            // Xử lý xóa bài viết
            $('.delete-blog').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Bạn không thể hoàn tác sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi request xóa
                        $.ajax({
                            url: `{{ route('admin.blogs.delete', '') }}/${id}`,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Đã xóa!',
                                        response.message || 'Bài viết đã được xóa thành công.',
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Lỗi!',
                                        response.message || 'Có lỗi xảy ra khi xóa bài viết.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                console.error('Lỗi:', xhr);
                                Swal.fire(
                                    'Lỗi!',
                                    xhr.responseJSON?.message || 'Có lỗi xảy ra khi xóa bài viết.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
