@extends('backend.layouts.master')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="row">
        {{-- Danh sách bên trái --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title d-flex align-items-center">
                        Danh sách danh mục keyword
                        <a href="{{ route('admin.keywords.trash') }}" class="ms-3 text-danger" title="Thùng rác">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </h4>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Vị trí hiển thị
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll" /></th>
                                    <th>STT</th>
                                    <th>Tên keyword</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keywords as $item)
                                    <tr>
                                        <td><input type="checkbox" id="selectAll" /></td>
                                        <td>{{ $loop->iteration }}</td> 
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            <i class="fa-solid fa-pen m-4 text-primary" style="cursor: pointer"
                                                data-bs-toggle="modal" data-bs-target="#editKeywordModal"
                                                data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                data-slug="{{ $item->slug }}">
                                            </i>

                                            <i class="fa-solid fa-trash m-4 text-danger" style="cursor: pointer"
                                                onclick="confirmDelete({{ $item->id }}, '{{ $item->name }}')">
                                            </i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form thêm mới bên phải --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm keyword mới</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.keywords.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên keyword</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@include('backend.keyword.edit');


@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script> <!-- Dùng jquery.dataTables.min.js thay vì dataTables.js -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        $(document).on('click', '.fa-pen', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const slug = $(this).data('slug');
            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#editKeywordForm').attr('action', `/admin/keywords/${id}`);
        });
    </script>

    <script src="{{ asset('resources/js/modal_keyword.js') }}"></script>

    <script>
        function confirmDelete(id, name) {
            if (confirm("Bạn có chắc chắn muốn xóa keyword: " + name + "?")) {
                const form = document.getElementById('deleteForm');
                form.action = '/admin/keywords/' + id + '/soft-delete';
                form.submit();
            }
        }
    </script>
@endpush
