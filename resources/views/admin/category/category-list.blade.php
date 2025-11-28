@extends('layout/admin')
@section('body')
    <div class="card-footer small text mutter">
        <table class="table">
            <h3>Category</h3>
            <a href="{{route('admin.category.create')}}" class="btn btn-primary">Add Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($categories) && count($categories) > 0)
                    @foreach ($categories as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        
                        <td>
                            <a href="{{route('admin.category.edit', $item->id)}}">
                                <i class="fa-solid fa-pen-to-square text-warning"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục: {{ $item->name }} không ?')">
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-link p-0" style="border: none; background: none;">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Chưa có sản phẩm nào.</td>
                    </tr>
                @endif
                </tbody>
        </table>
    </div>
@endsection