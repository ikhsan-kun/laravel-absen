<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $absensi = Absensi::with('user')->get();
        } else {
            $absensi = Absensi::where('user_id', $user->id)->get();
        }

        return view('dashboard', compact('absensi'));
    }

    public function absenMasuk()
    {
        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Absen masuk berhasil');
    }

    public function absenKeluar()
    {
        $absen = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', now()->toDateString())
            ->first();

        if ($absen) {
            $absen->update(['jam_keluar' => now()->toTimeString()]);
        }

        return redirect()->back()->with('success', 'Absen keluar berhasil');
    }
}

