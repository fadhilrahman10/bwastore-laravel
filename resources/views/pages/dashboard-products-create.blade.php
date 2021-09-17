@extends('layouts.dashboard')

@section('title')
    Store - Products - Create
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Add New Product</h2>
            <p class="dashboard-subtitle">
                Create your own product
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-products-store') }}" method="POST" enctype="multipart/form-data">
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
                                                value="{{ old('name') }}"
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
                                                value="{{ old('price') }}"
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
                                            {{ old('description') }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="thumbnails">Thumbnails</label>
                                            <input
                                                type="file"
                                                multiple
                                                class="form-control pt-1"
                                                id="thumbnails"
                                                aria-describedby="thumbnails"
                                                name="photo"
                                            />
                                            @error('photo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @else
                                            <small class="text-muted">
                                                Kamu dapat memilih lebih dari satu file
                                            </small>
                                            @enderror
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
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("description");
</script>
@endpush
