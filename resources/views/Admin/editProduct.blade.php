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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">
                        <i class="fa fa-edit me-2"></i> Edit Product
                    </h4>
                </div>

                <div class="card-body p-4">
                    @if($product->getMedia('product_images')->isNotEmpty())
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Current Product Images
                            </label>

                            <div class="d-flex flex-wrap gap-3 mt-2">
                                @foreach($product->getMedia('product_images') as $media)
                                    <div class="position-relative" style="width:120px;">
                                        <img src="{{ $media->getUrl() }}" class="img-thumbnail rounded">

                                        <form
                                            action="{{ route('Admin.deleteProductImage', $media->id) }}"
                                            method="POST"
                                            class="position-absolute"
                                            style="top:5px; right:5px;"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm rounded-circle"
                                                onclick="return confirm('Are you sure?')"
                                                title="Delete image"
                                            >
                                                &times;
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('Admin.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Select Category <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" class="form-select form-control-lg" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="product_name"
                                   class="form-control form-control-lg"
                                   value="{{ old('product_name', $product->product_name) }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Product SKU <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="product_id"
                                   class="form-control form-control-lg"
                                   value="{{ old('product_id', $product->product_id) }}"
                                   required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Current Price <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01"
                                       name="price"
                                       class="form-control form-control-lg"
                                       value="{{ old('price', $product->price) }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Previous Price
                                </label>
                                <input type="number" step="0.01"
                                       name="previous_price"
                                       class="form-control form-control-lg"
                                       value="{{ old('previous_price', $product->previous_price) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="quantity"
                                       class="form-control form-control-lg"
                                       value="{{ old('quantity', $product->quantity) }}"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Alert Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                       name="alert_quantity"
                                       class="form-control form-control-lg"
                                       value="{{ old('alert_quantity', $product->alert_quantity) }}"
                                       required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Add New Product Images
                            </label>
                            <input type="file"
                                   name="images[]"
                                   class="form-control form-control-lg"
                                   multiple>
                            <small class="text-muted">
                                Optional — upload JPEG/PNG images
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-save me-1"></i> Update Product
                            </button>
                            <a href="{{ route('Admin.productList') }}" class="btn btn-secondary btn-lg">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    <small>Update product information carefully</small>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
