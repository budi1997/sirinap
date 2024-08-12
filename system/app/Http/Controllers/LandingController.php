<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        // $data['list_kamar'] = Kamar::all();
        $data['list_kamar'] = Kamar::whereNotIn('id_kamar', [999])
            ->select('tipe_kamar', DB::raw('MIN(id_kamar) as id_kamar'), DB::raw('MIN(harga) as harga'))
            ->groupBy('tipe_kamar')
            ->get();

        $data['list_penginapan'] = Penginapan::all();

        return view('web.index', $data);
    }
    public function hubungiKami()
    {
        // $data['list_kamar'] = Kamar::all();
        return view('web.hubungiKami');
    }
    public function kamar()
    {
        $data['list_kamar'] = Kamar::where('status', 'Tersedia')->whereNotIn('id_kamar', [999])->get();

        // $data['list_kamar'] = Kamar::whereNotIn('id_kamar', [999])
        //     ->whereDoesntHave('reservasis', function ($query) {
        //         $query->whereIn('status', ['booked', 'Verified', 'Confirmed', 'Checked-in']);
        //     })->get();

        return view('web.kamar', $data);
    }

    public function detailKamar($id)
    {
        $data['kamar'] = Kamar::findOrFail($id);

        return view('web.detailKamar', $data);
    }

    public function filter(Request $request)
    {
        $tipe_kamar = $request->input('tipe_kamar');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        $query = Kamar::query();

        // Filter berdasarkan tipe kamar
        if ($tipe_kamar && $tipe_kamar != 'select') {
            $query->where('tipe_kamar', $tipe_kamar);
        } elseif ($request->has('penginapan')) {
            $penginapan = $request->input('penginapan');
            $query->where('id_penginapan', $penginapan);
        }

        // Filter berdasarkan tanggal checkin dan checkout
        if ($checkin && $checkout) {
            $query->whereDoesntHave('reservasis', function ($q) use ($checkin, $checkout) {
                $q->where(function ($query) use ($checkin, $checkout) {
                    $query->whereBetween('tanggal_check_in', [$checkin, $checkout])
                        ->orWhereBetween('tanggal_check_out', [$checkin, $checkout])
                        ->orWhere(function ($query) use ($checkin, $checkout) {
                            $query->where('tanggal_check_in', '<=', $checkin)
                                ->where('tanggal_check_out', '>=', $checkout);
                        });
                });
            });
        }

        // Menampilkan kamar yang tersedia dan tidak memiliki id 999 (sesuai contoh yang diberikan)
        $data['list_kamar'] = $query->whereNotIn('id_kamar', [999])->with('galeri')->get();

        return view('web.kamar', $data);
    }

    // public function fasilitas()
    // {
    //     $data['list_kamar'] = Kamar::all();
    //     return view('web.index', $data);
    // }
    public function galeri()
    {
        $data['list_galeri'] = Galeri::all();
        return view('web.galeri', $data);
    }
}
