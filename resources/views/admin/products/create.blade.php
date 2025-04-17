@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h2>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h2>

    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price (₹)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            <div id="preview" class="mt-2">
                @if(isset($product) && $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="100">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($product) ? 'Update' : 'Create' }} Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.innerHTML = '<img src="' + reader.result + '" width="100">';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
