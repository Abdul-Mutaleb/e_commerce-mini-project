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
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4 class="mb-0">
                            <i class="fa fa-box me-2"></i> Add New Product
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('Admin.addProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Select Category <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" class="form-select form-control-lg" required>
                                    <option value="" selected disabled>Choose a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="product_name" class="form-control form-control-lg"
                                    placeholder="Enter product name" required>
                                @error('product_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Product SKU <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="product_id" class="form-control form-control-lg"
                                    placeholder="Enter product SKU" required>
                                @error('product_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Current Price <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="0.01" name="price" class="form-control form-control-lg"
                                        placeholder="Enter price" required>
                                    @error('price')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Previous Price
                                    </label>
                                    <input type="number" step="0.01" name="previous_price"
                                        class="form-control form-control-lg" placeholder="Old price (optional)">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="quantity" class="form-control form-control-lg"
                                        placeholder="Available stock" required>
                                    @error('quantity')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Alert Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="alert_quantity" class="form-control form-control-lg"
                                        placeholder="Low stock alert" required>
                                    @error('alert_quantity')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Product Images <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="images[]" class="form-control form-control-lg" multiple required>
                                @error('images')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fa fa-plus-circle me-1"></i> Add Product
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center text-muted">
                        <small>Ensure all required product information is correct</small>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection