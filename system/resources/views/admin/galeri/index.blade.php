@extends('admin.template.base')

@section('title', 'SIRInap - Galeri')

@section('content')
    <style>
        .btn-icon-left {
            margin-right: .5rem !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Galeri</h4>
                    {{-- <span class="ml-1">Mengelola data galeri (penambahan, pengeditan, dan penghapusan)</span> --}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                {{-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active"><a href="#">kamar</a></li>
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
                        <h4 class="card-title">Data kamar</h4>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        {{-- <th>Kamar</th> --}}
                                        <th>URL Gambar</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_galeri as $galeri)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $galeri->kamar->tipe_kamar }} - {{ $galeri->kamar->nomor_kamar }}</td> --}}
                                            <td>
                                                <img src="{{ url('system/storage/app/public/' . $galeri->url_gambar) }}"
                                                    alt="{{ $galeri->deskripsi_gambar }}" style="max-width: 100px;">
                                            </td>
                                            <td>{{ $galeri->deskripsi_gambar }}</td>
                                            <td>
                                                <div class="tooltip-container">
                                                    <button type="button" class="btn btn-primary btn-xs"
                                                        data-toggle="modal"
                                                        data-target="#editModal{{ $galeri->id_galeri }}"><i
                                                            class="fas fa-edit"></i>
                                                    </button>
                                                    <div class="tooltip-text">Edit Data</div>
                                                </div>
                                                <div class="tooltip-container">
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                                        data-target="#deleteModal{{ $galeri->id_galeri }}"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                    <div class="tooltip-text">Hapus Data</div>
                                                </div>
                                            </td>
                                        </tr>

                                        @include('admin.galeri.modalEdit')
                                        @include('admin.galeri.modalDelete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.galeri.modalCreate')

@endsection

@section('scripts')
    <script>
        $('#createForm').validate({
            rules: {
                id_kamar: {
                    required: true
                    // minlength: 2
                },
                gambar: {
                    required: true
                }
            },
            messages: {
                id_kamar: {
                    required: "Data tidak boleh kosong"
                    // minlength: "Your name must consist of at least 2 characters"
                },
                gambar: {
                    required: "Data tidak boleh kosong"
                }
            },
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        // $('.editForm').each(function() {
        //     $(this).validate({
        //         rules: {
        //             id_kamar: {
        //                 required: true
        //             }
        //         },
        //         messages: {
        //             id_kamar: {
        //                 required: "Silahkan pilih tag"
        //             }
        //         },
        //         errorClass: 'is-invalid',
        //         validClass: 'is-valid',
        //         errorPlacement: function(error, element) {
        //             console.log("Error placement called for:", element);
        //             error.addClass('invalid-feedback');
        //             element.closest('.form-group').append(error);
        //         },
        //         highlight: function(element) {
        //             console.log("Highlight called for:", element);
        //             $(element).addClass('is-invalid').removeClass('is-valid');
        //         },
        //         unhighlight: function(element) {
        //             console.log("Unhighlight called for:", element);
        //             $(element).addClass('is-valid').removeClass('is-invalid');
        //         },
        //         submitHandler: function(form) {
        //             console.log("Submit handler called");
        //             // form.submit();
        //         }
        //     });
        // });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            $('#deleteForm').attr('action', 'kamar/' + id);
        });
    </script>
@endsection
