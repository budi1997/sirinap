<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var penginapan = button.data('penginapan');
        var nomor_kamar = button.data('nomorkamar');
        var tipe_kamar = button.data('tipekamar');
        var harga = button.data('harga');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#editPenginapan').val(penginapan);
        modal.find('#editNomorKamar').val(nomor_kamar);
        modal.find('#editTipeKamar').val(tipe_kamar);
        modal.find('#editHarga').val(harga);
        modal.find('#editStatus').val(status);
        $('#editForm').attr('action', 'kamar/' + id);
    });

    $('#createForm, #editForm').each(function() {
        $(this).validate({
            rules: {
                penginapan: {
                    required: true
                },
                nomor_kamar: {
                    required: true
                },
                tipe_kamar: {
                    required: true
                },
                harga: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                penginapan: {
                    required: "Data tidak boleh kosong"
                },
                nomor_kamar: {
                    required: "Data tidak boleh kosong"
                },
                tipe_kamar: {
                    required: "Data tidak boleh kosong"
                },
                harga: {
                    required: "Data tidak boleh kosong"
                },
                status: {
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
    });

    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        $('#deleteForm').attr('action', 'kamar/' + id);
    });
</script>
