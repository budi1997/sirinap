@extends('admin.template.base')

@section('title', 'SIRInap - Daftar Penginapan')

@section('content')
    <style>
        .btn-icon-left {
            margin-right: .5rem !important;
        }

        .border-danger {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
        }

        .error {
            color: red;
        }
    </style>

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Daftar Penginapan</h4>
                    {{-- <span class="ml-1">Mengelola data penginapan (penambahan, pengeditan, dan penghapusan)</span> --}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                {{-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active"><a href="#">penginapan</a></li>
                </ol> --}}
                <button type="button" class="btn btn-rounded btn-success" data-toggle="modal" data-target="#createModal">
                    <span class="btn-icon-left text-success">
                        <i class="fa fa-plus"></i>
                    </span>Tambah Data
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">Data penginapan</h4>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 15%">Nama Penginapan</th>
                                        <th style="width: 20%">Alamat</th>
                                        <th style="width: 15%">Deskripsi</th>
                                        {{-- <th style="width: 10%">Link Map</th> --}}
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_penginapan as $penginapan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $penginapan->nama }} <br>
                                                <img src="{{ url('system/storage/app/public/' . $penginapan->gambar) }}"
                                                    alt="{{ $penginapan->gambar }}" style="max-width: 100px;">
                                            </td>
                                            <td>
                                                {{ $penginapan->alamat }}, {{ $penginapan->kota }},
                                                {{ $penginapan->provinsi }} {{ $penginapan->kode_pos }}
                                            </td>
                                            <td>{{ $penginapan->deskripsi }}</td>
                                            {{-- <td>
                                                <a href="/{{ $penginapan->link_map }}" target="_blank"
                                                    class="btn btn-success btn-xs">Klik disini</a>
                                            </td> --}}
                                            <td>
                                                <div class="tooltip-container">
                                                    <button type="button" class="btn btn-primary btn-xs"
                                                        data-toggle="modal"
                                                        data-target="#editModal{{ $penginapan->id_penginapan }}"><i
                                                            class="fas fa-edit"></i>
                                                    </button>
                                                    <div class="tooltip-text">Edit Data</div>
                                                </div>
                                                <div class="tooltip-container">
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                                        data-target="#deleteModal{{ $penginapan->id_penginapan }}"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                    <div class="tooltip-text">Hapus Data</div>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin.penginapan.modalEdit')
                                        @include('admin.penginapan.modalDelete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.penginapan.modalCreate')

@endsection

@section('scripts')
    @include('admin.penginapan.scripts')
@endsection
