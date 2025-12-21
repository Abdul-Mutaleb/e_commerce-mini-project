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
            <h3>All Products</h3>
            <a href="{{ route('Admin.addProduct') }}" class="btn btn-primary">
                Add New Product
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Alert Quantity</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $item)
                        @php
                            $product = \App\Models\Product::find($item->id);
                        @endphp
                        <tr>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>
                                @if($product && $product->getMedia('product_images')->count())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($product->getMedia('product_images') as $image)
                                            <img src="{{ $image->getUrl() }}" width="45" height="45"
                                                class="border rounded object-fit-cover">
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->alert_quantity }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('Admin.editProduct', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('Admin.deleteProduct', $item->id) }}" method="POST"
                                        style="margin:0;">
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
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No products found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection