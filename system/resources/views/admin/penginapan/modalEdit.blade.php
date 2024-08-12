<!-- Modal Edit Admin -->
<div class="modal fade" id="editModal{{ $penginapan->id_penginapan }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="editForm" method="POST" action="{{ route('penginapan.update', $penginapan->id_penginapan) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><i class="fas fa-hotel"></i> Edit Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Penginapan</label>
                        <input type="text" name="nama" class="form-control" required value="{{$penginapan->nama}}">                        
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{$penginapan->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" name="kota" class="form-control" required value="{{$penginapan->kota}}">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" required value="{{$penginapan->provinsi}}">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="number" name="kode_pos" class="form-control" required value="{{$penginapan->kode_pos}}">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{$penginapan->deskripsi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link Map</label>
                        <input type="text" name="link_map" class="form-control" required value="{{$penginapan->link_map}}">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
