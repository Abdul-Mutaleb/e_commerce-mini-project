@extends('Admin.mainDashboard')
@section('content')
<div class="container mt-4">
    <h2>Edit Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- ✅ Display current images with delete buttons (OUTSIDE the main form) -->
    @if($product->getMedia('product_images')->isNotEmpty())
        <div class="mb-4">
            <label class="form-label fw-bold">Current Product Images</label>
            <div class="d-flex flex-wrap gap-3 mt-2">
                @foreach($product->getMedia('product_images') as $media)
                    <div class="position-relative" style="width: 120px;">
                        <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-thumbnail">
                        <form 
                            action="{{ route('Admin.deleteProductImage', $media->id) }}" 
                            method="POST" 
                            class="d-inline position-absolute" 
                            style="top: 5px; right: 5px; z-index: 10;"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="btn btn-danger btn-sm rounded-circle p-1"
                                onclick="return confirm('Are you sure you want to delete this image?');"
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

    <!-- ✅ Main product update form -->
    <form action="{{ route('Admin.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" value="{{ old('product_id', $product->product_id) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="previous_price" class="form-label">Previous Price</label>
            <input type="number" name="previous_price" class="form-control" value="{{ old('previous_price', $product->previous_price) }}" step="0.01">
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="alert_quantity" class="form-label">Alert Quantity</label>
            <input type="number" name="alert_quantity" class="form-control" value="{{ old('alert_quantity', $product->alert_quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Upload new images -->
        <div class="mb-3">
            <label for="images" class="form-label">Add New Product Images (Optional)</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            <small class="form-text text-muted">You can upload multiple images (JPEG, PNG, max 2MB each).</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('Admin.productList') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection