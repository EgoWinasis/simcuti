<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->isActive == 0) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is inactive. Please contact Admin support.');
        }
        if (Auth::user()->role == 'user') {
            $totalHari = DB::table('cuti')
            ->where('nip', '=', Auth::user()->nip)
            ->where(function ($query) {
                $query->where('status', '=', 'Pending')
                      ->orWhere('status', '=', 'Disetujui');
            })
            ->sum('hari');
            $batalCount = DB::table('cuti')
                ->where('nip', '=', Auth::user()->nip)
                ->where('status', '=', 'Batal')
                ->count();
            $pendingCount = DB::table('cuti')
                ->where('nip', '=', Auth::user()->nip)
                ->where('status', '=', 'Pending')
                ->count();
            $disetujuiCount = DB::table('cuti')
                ->where('nip', '=', Auth::user()->nip)
                ->where('status', '=', 'Disetujui')
                ->count();
            $ditolakCount = DB::table('cuti')
                ->where('nip', '=', Auth::user()->nip)
                ->where('status', '=', 'Ditolak')
                ->count();

            return view('home', compact('totalHari','batalCount', 'disetujuiCount','pendingCount', 'ditolakCount'));
        } 
        if (Auth::user()->role == 'admin') {
            $batalCount = DB::table('cuti')
                ->where('status_admin', '=', 'Batal')
                ->count();
            $pendingCount = DB::table('cuti')
                ->where('status_admin', '=', 'Pending')
                ->count();
            $disetujuiCount = DB::table('cuti')
                ->where('status_admin', '=', 'Disetujui')
                ->count();
            $ditolakCount = DB::table('cuti')
                ->where('status_admin', '=', 'Ditolak')
                ->count();
            $totalUsersActive = DB::table('users')
                ->where('isActive', '=', '1')
                ->count();
            $totalUsersInActive = DB::table('users')
                ->where('isActive', '=', '0')
                ->count();

            return view('home', compact('totalUsersActive','totalUsersInActive','batalCount', 'disetujuiCount','pendingCount', 'ditolakCount'));
        } 
        if (Auth::user()->role == 'kepala') {
            
            $batalCount = DB::table('cuti')
                ->where('bagian', '=', Auth::user()->bagian)
                ->where('status', '=', 'Batal')
                ->where('alasan', '=', '-')
                ->count();
            $pendingCount = DB::table('cuti')
                ->where('bagian', '=', Auth::user()->bagian)
                ->where('status', '=', 'Pending')
                ->where('alasan', '=', '-')
                ->count();
            $disetujuiCount = DB::table('cuti')
                ->where('bagian', '=', Auth::user()->bagian)
                ->where('status', '=', 'Disetujui')
                ->where('alasan', '=', '-')
                ->count();
            $ditolakCount = DB::table('cuti')
                ->where('bagian', '=', Auth::user()->bagian)
                ->where('status', '=', 'Ditolak')
                ->where('status_admin', '=', 'Disetujui')
                ->count();

            return view('home', compact('batalCount', 'disetujuiCount','pendingCount', 'ditolakCount'));
        } 
    }
}
