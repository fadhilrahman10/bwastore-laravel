@extends('layouts.dashboard')

@section('title')
    Store - Products - Detail
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Shirup Marzan</h2>
            <p class="dashboard-subtitle">
                Product Details
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-products-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input
                                                type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                aria-describedby="name"
                                                name="name"
                                                value="{{ old('name', $product->name) }}"
                                            />
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input
                                                type="number"
                                                class="form-control @error('price') is-invalid @enderror"
                                                id="price"
                                                aria-describedby="price"
                                                name="price"
                                                value="{{ old('price', $product->price) }}"
                                            />
                                            @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="{{ $product->category->id }}" selected>Tidak diganti({{ $product->category->name }})</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            @error('description')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <textarea
                                                name="description"
                                                id="description"
                                                cols="30"
                                                rows="4"
                                                class="form-control"
                                            >
                                            {{ old('description', $product->description) }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 mb-5">
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block px-5">
                                    Save Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($product->galleries as $gallery)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img
                                        src="{{ Storage::url($gallery->photo) ?? '' }}"
                                        alt=""
                                        class="w-100"
                                        />
                                        <a class="delete-gallery" href="{{ route('dashboard-products-gallery-delete', $gallery->id) }}">
                                            <img src="/images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 mt-3">
                                    <form action="{{ route('dashboard-products-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input
                                            type="file"
                                            id="file"
                                            name="photo"
                                            style="display: none;"
                                            onchange="form.submit()"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-block mb-5"
                                            onclick="thisFileUpload();"
                                        >
                                            Add Photo
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    function thisFileUpload() {
    document.getElementById("file").click();
    }
</script>
<script>
    CKEDITOR.replace("description");
</script>
@endpush
