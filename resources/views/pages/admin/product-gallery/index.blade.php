@extends('layouts.admin')

@section('title')
    Store - Admin Dashboard - Product Galleries
@endsection

@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Galleries</h2>
                <p class="dashboard-subtitle">
                    List of Product Galleries
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="gallery/create" class="btn btn-primary mb-3">
                                    + Create new product gallery
                                </a>
                                @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="tabel">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Produk</td>
                                                <td>Foto</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
    <script>
        $(document).ready(function(){
            $('#tabel').DataTable({
                processing:true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    {data:'id', name:'id'},
                    {data:'product.name', name:'product.name'},
                    {data:'photo', name:'photo'},
                    {
                        data:'action',
                        name:'action',
                        orderable: false,
                        searcable: false,
                        width: '15%'
                    }
                ]
            });
        });
    </script>
@endpush
