@extends('adminlte::page')

@section('title','Beranda')
@section('content_header')
<h1>Beranda</h1>
<link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
@stop

@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                @if ($message = Session::get('error'))
                <x-adminlte-alert theme="warning" title="Warning">
                    <p>{{ $message }}</p>
                    <p>Perbarui profile terlebih dahulu!</p>

                </x-adminlte-alert>
                @endif
                @if (Auth::user()->role == 'user')
                @include('dashboard_user')
                @endif
                @if (Auth::user()->role == 'admin')
                @include('dashboard_admin')
                @endif
                @if (Auth::user()->role == 'kepala')
                @include('dashboard_kepala')
                @endif

            </div>
        </main>
    </div>
</div>
@section('footer')
<div id="mycredit" class="small"><strong> Copyright &copy;
        <?php echo date('Y');?> Sistem Informasi Pengajuan Cuti Pegawai BLUD - Mufasirin </div>
@stop
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('js')

@stop