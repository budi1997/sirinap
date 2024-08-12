<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('web.profile');
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

        // Log::info('Data request:', $request->all());

        $user = User::findOrFail($id);

        if ($request->hasFile('ktp')) {
            $request->validate([
                'ktp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Hapus ktp lama dari storage
            Storage::disk('public')->delete($user->url_ktp);

            // Menghasilkan nama unik untuk file ktp baru
            $namaFile = uniqid() . '.' . $request->ktp->getClientOriginalExtension();

            // Simpan ktp baru ke storage dengan nama yang dihasilkan secara acak
            $ktpPath = $request->file('ktp')->storeAs('ktp', $namaFile, 'public');

            // Update path ktp di database
            $user->url_ktp = $ktpPath;
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->telepon = $request->telepon;
        $user->alamat = $request->alamat;

        if($user->save()){
            session()->put('user', $user);
            
            return redirect('/profile')->with('success', 'Data konsumen berhasil diubah.');
        }else{
            dd('gagal save');
        }

    }
}
