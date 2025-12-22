@extends('Admin.mainDashboard')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
            <h3>All Categories</h3>
            <a href="{{ route('Admin.addCategory') }}" class="btn btn-primary">Add New Category</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created_category</th>
                        <th>Updated_category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categoryList as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                           
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at}}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('Admin.editCategory', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Admin.deleteCategory', $category->id) }}" method="POST"
                                        style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection