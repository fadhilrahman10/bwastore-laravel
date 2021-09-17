@extends('layouts.dashboard')

@section('title')
    Store - Dashboard - Products
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Products</h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a
                        href="{{ route('dashboard-products-create') }}"
                        class="btn btn-success"
                        >Add New Product</a
                    >
                </div>
            </div>
            <div class="row mt-4">
                @if (session()->has('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                @forelse ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a
                            class="card card-dashboard-product d-block"
                            href="{{ route('dashboard-products-details', $product->id) }}"
                        >
                            <div class="card-body">
                                <img
                                    src="{{ Storage::url($product->galleries->first()->photo) }}"
                                    alt=""
                                    class="w-100 mb-2"
                                />
                                <div class="product-title">{{ $product->name }}</div>
                                <div class="product-category">{{ $product->category->name }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center">
                        You dont have product!
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</div>
@endsection
