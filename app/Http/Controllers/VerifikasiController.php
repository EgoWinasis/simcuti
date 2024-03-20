<?php

namespace App\Http\Controllers;

use App\Models\ModelCuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses Ditolak ');
        }
        if (Auth::user()->role == 'kepala') {

            $cuti = DB::table('cuti')
                ->select('*')
                ->where('bagian', '=', Auth::user()->bagian)
                ->where('name', '!=', Auth::user()->name)
                ->where('status_admin', '=', 'Disetujui')
                ->where(function ($query) {
                    $query->where('status', '=', 'Pending')
                        ->orWhere('status', '=', 'Disetujui')
                        ->orWhere('status', '=', 'Ditolak');
                })
                ->orderBy('created_at', 'desc')
                ->get();
            return view('verif_cuti.verif_cuti_view')->with(compact('cuti'));
        }
        if (Auth::user()->role == 'admin') {

            $cuti = DB::table('cuti')
                ->select('*')
                ->where('name', '!=', Auth::user()->name)
                ->where(function ($query) {
                    $query->where('status', '=', 'Pending')
                        ->orWhere('status', '=', 'Disetujui')
                        ->orWhere('status', '=', 'Ditolak');
                })
                ->orderBy('created_at', 'desc')
                ->get();
            return view('verif_cuti.verif_cuti_admin_view')->with(compact('cuti'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $cuti = ModelCuti::find($id); // Find the record by ID
        if ($request->has('alasan') && !empty($request->alasan)) {
            $cuti->alasan = $request->alasan;
            $cuti->save();
        } else {
            if (Auth::user()->role == 'admin') {
                $cuti->status_admin = "Disetujui";
                $cuti->save();
            }

            if (Auth::user()->role == 'kepala') {
                $cuti->status = "Disetujui";
                $cuti->approve_by = Auth::user()->name;
                $cuti->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modelCuti = ModelCuti::find($id);
        if ($modelCuti) {
            if (Auth::user()->role == 'admin') {
                $modelCuti->status_admin = 'Ditolak';
                $modelCuti->status = 'Ditolak';
                $modelCuti->save();
                $modelCuti->delete();
            }
            if (Auth::user()->role == 'kepala') {
                $modelCuti->status = 'Ditolak';
                $modelCuti->save();
                $modelCuti->delete();
            }
        }
    }
}
