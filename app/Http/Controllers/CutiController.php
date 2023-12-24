<?php

namespace App\Http\Controllers;

use App\Models\ModelCuti;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses Ditolak ');
        }
        $cuti = DB::table('cuti')
            ->select('*')
            ->where('nip', '=', Auth::user()->nip)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($cuti);
        return view('cuti.cuti_view')->with(compact('cuti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $totalHari = DB::table('cuti')
            ->where('nip', '=', Auth::user()->nip)
            ->where(function ($query) {
                $query->where('status', '=', 'Pending')
                      ->orWhere('status', '=', 'Disetujui');
            })
            ->sum('hari');

        if ($totalHari >= 12) {
            return redirect()->route('cuti.index')->with('error', 'Jatah cuti anda sudah habis');
        }

        // 
        $user = DB::table('users')
            ->select('id', 'nip', 'name', 'email', 'bagian', 'pangkat', 'jabatan')
            ->where('id', '=', Auth::user()->id)
            ->get();
        return view('cuti.cuti_create_view')->with(compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $totalHari = DB::table('cuti')
            ->where('nip', '=', Auth::user()->nip)
            ->where(function ($query) {
                $query->where('status', '=', 'Pending')
                      ->orWhere('status', '=', 'Disetujui');
            })
            ->sum('hari');

        if ($totalHari >= 12) {
            return redirect()->route('cuti.index')->with('error', 'Jatah cuti anda sudah habis');
        }
        $validatedData = $request->validate([
            'nip' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'bagian' => ['required', 'string', 'max:255'],
            'pangkat' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],

            'jenis_cuti' => ['required', 'string', 'max:255'],
            'tgl_cuti' => ['required', 'string', 'max:255'],
            'alamat_cuti' => ['required', 'string', 'max:255'],

        ]);

        if (strpos($validatedData['tgl_cuti'], ' to ') !== false) {
            // Extracting start and end dates
            $dates = explode(' to ', $validatedData['tgl_cuti']);
        }else {
            $dates = [1];
        }
        if (count($dates) === 2) {
            $startDate = new DateTime($dates[0]);
            $endDate = new DateTime($dates[1]);

            $interval = $startDate->diff($endDate);
            $countOfDays = $interval->days + 1;
        } else {
            $countOfDays = 1;
        }

        $validatedData['hari'] = $countOfDays;
        $validatedData['status'] = 'Pending';
        $validatedData['status_admin'] = 'Pending';
        $validatedData['approve_by'] = '-';
        // store to database
        ModelCuti::create($validatedData);
        return redirect()->route('cuti.index')
            ->with('success', 'Berhasil Mengajukan Cuti');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cuti =  DB::table('cuti')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return response()->json(['cuti' => $cuti]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modelCuti = ModelCuti::find($id);
        if ($modelCuti) {
            $modelCuti->status = 'Batal';
            $modelCuti->save();
            $modelCuti->delete();
        }
    }
}
