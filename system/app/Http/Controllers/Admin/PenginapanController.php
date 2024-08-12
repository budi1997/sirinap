<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function index()
    {
        $data['list_penginapan'] = Penginapan::all();

        return view('admin.penginapan.index', $data);
    }

    public function store(Request $request)
    {
        // Log::info('Store method called.');
        // Log::info($request->all());
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|numeric',
            'deskripsi' => 'required',
            'link_map' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Menghasilkan nama unik untuk file gambar
        $namaFile = uniqid() . '.' . $request->gambar->getClientOriginalExtension();

        // Simpan gambar ke storage dengan nama unik
        $gambarPath = $request->file('gambar')->storeAs('penginapan', $namaFile, 'public');
        
        Penginapan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'deskripsi' => $request->deskripsi,
            'link_map' => $request->link_map,
            'gambar' => $gambarPath,
        ]);

        return redirect('administrator/penginapan')->with('success', 'Data penginapan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|numeric',
            'deskripsi' => 'required',
            'link_map' => 'required',
        ]);

        $query = Penginapan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);

            // Hapus gambar lama dari storage
            if (!empty($query->url_gambar)) {
                Storage::disk('public')->delete($query->url_gambar);
            }

            // Menghasilkan nama unik untuk file gambar baru
            $namaFile = uniqid() . '.' . $request->gambar->getClientOriginalExtension();

            // Simpan gambar baru ke storage dengan nama yang dihasilkan secara acak
            $gambarPath = $request->file('gambar')->storeAs('galeri', $namaFile, 'public');

            // Update path gambar di database
            $query->gambar = $gambarPath;
        }

        $query->nama = $request->nama;
        $query->alamat = $request->alamat;
        $query->kota = $request->kota;
        $query->provinsi = $request->provinsi;
        $query->kode_pos = $request->kode_pos;
        $query->deskripsi = $request->deskripsi;
        $query->link_map = $request->link_map;
        $query->save();

        return redirect('administrator/penginapan')->with('success', 'Data penginapan berhasil diubah.');
    }

    public function destroy($id)
    {
        $admin = Penginapan::findOrFail($id);
        $admin->delete();

        return redirect('administrator/penginapan')->with('success', 'Data penginapan berhasil dihapus.');
    }
}
