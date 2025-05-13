@extends('backend.layouts.master')

@section('title', 'Danh sách keywords bị xóa')

@section('content')
    <div class="row">
        {{-- Danh sách bên trái --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title d-flex align-items-center">
                        <a href="{{ route('admin.keywords.index') }}" class="me-2 text-dark">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        Danh sách danh mục keyword bị xóa
                    </h4>
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
                                    <th>Thời gian xóa</th>
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
                                        <td>{{ $item->deleted_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <i class="fa-solid fa-trash-arrow-up m-4 text-success" style="cursor: pointer"
                                                onclick="confirmRestore({{ $item->id }}, '{{ $item->name }}')">
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
    </div>
@endsection

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" id="formMethod" value="PUT">
</form>


@push('scripts')
    <script>
        function confirmRestore(id, name) {
            if (confirm("Bạn có chắc chắn muốn khôi phục keyword: " + name + "?")) {
                const form = document.getElementById('deleteForm');
                const method = document.getElementById('formMethod');
                method.value = 'PUT'; 
                form.action = '/admin/keywords/' + id + '/restore';
                form.submit();
            }
        }

        function confirmDelete(id, name) {
            if (confirm("Bạn có chắc chắn muốn xóa keyword: " + name + "?")) {
                const form = document.getElementById('deleteForm');
                const method = document.getElementById('formMethod');
                method.value = 'DELETE'; 
                form.action = '/admin/keywords/' + id + '/delete';
                form.submit();
            }
        }
    </script>
@endpush
