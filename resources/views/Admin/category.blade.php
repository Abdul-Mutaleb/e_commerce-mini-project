@extends("Admin.mainDashboard")

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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4 class="mb-0">
                            <i class="fa fa-tags me-2"></i> Add New Category
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route("Admin.category") }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Category Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="category_name" id="category_name" class="form-control form-control-lg"
                                    placeholder="Enter category name" required>
                            </div>

                            @error('category_name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fa fa-plus-circle me-1"></i> Add Category
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        <small>Make sure category name is unique</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection