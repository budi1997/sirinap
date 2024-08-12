<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index()
    {
        $data['list_pelanggan'] = User::all();
        return view('admin.users.pelanggan.index', $data);
    }

    public function store(Request $request)
    {
        Log::info('Store method called.');
        Log::info($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        // Menghasilkan nama unik untuk file ktp
        $namaFile = uniqid() . '.' . $request->ktp->getClientOriginalExtension();

        // Simpan ktp ke storage dengan nama unik
        $ktpPath = $request->file('ktp')->storeAs('ktp', $namaFile, 'public');

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'url_ktp' => $ktpPath,
        ]);

        return redirect('administrator/konsumen')->with('success', 'Data konsumen berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:3|confirmed',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $admin = User::findOrFail($id);

        if ($request->hasFile('ktp')) {
            $request->validate([
                'ktp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Hapus ktp lama dari storage
            Storage::disk('public')->delete($admin->url_ktp);

            // Menghasilkan nama unik untuk file ktp baru
            $namaFile = uniqid() . '.' . $request->ktp->getClientOriginalExtension();

            // Simpan ktp baru ke storage dengan nama yang dihasilkan secara acak
            $ktpPath = $request->file('ktp')->storeAs('ktp', $namaFile, 'public');

            // Update path ktp di database
            $admin->url_ktp = $ktpPath;
        }

        $admin->nama = $request->nama;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->jenis_kelamin = $request->jenis_kelamin;
        $admin->tgl_lahir = $request->tgl_lahir;
        $admin->telepon = $request->telepon;
        $admin->alamat = $request->alamat;
        $admin->save();

        return redirect('administrator/konsumen')->with('success', 'Data konsumen berhasil diubah.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect('administrator/konsumen')->with('success', 'Data konsumen berhasil dihapus.');
    }
}
