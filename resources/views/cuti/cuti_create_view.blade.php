@extends('adminlte::page')

@section('title','Pengajuan Cuti')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop
@section('content_header')
<h1>Pengajuan Cuti</h1>
@stop

@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('cuti.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <x-adminlte-card class="col-md-12" theme-mode="full">
                            <div class="row">
                                {{-- input form cuti --}}
                                {{-- NIP --}}
                                <div class="col-md-6">
                                    <label for="nis">NIP/NIPB</label>
                                    <x-adminlte-input name="nip" value="{{$user[0]->nip}}" readonly="true">
                                    </x-adminlte-input>
                                </div>
                                {{-- Nama --}}
                                <div class="col-md-6">
                                    <label for="name">Nama</label>
                                    <x-adminlte-input name="name" value="{{$user[0]->name}}" readonly="true">
                                    </x-adminlte-input>
                                </div>
                                <input type="hidden" name="email" value="{{$user[0]->email}}">
                                {{-- bagian --}}
                                <div class="col-md-6">
                                    <label for="bagian">Bagian / Satuan</label>
                                    <x-adminlte-input name="bagian" value="{{$user[0]->bagian}}" readonly="true">
                                    </x-adminlte-input>
                                </div>
                                {{-- pangkat --}}
                                <div class="col-md-6">
                                    <label for="pangkat">Pangkat/Gol. Ruang</label>
                                    <x-adminlte-input name="pangkat" value="{{$user[0]->pangkat}}" readonly="true">
                                    </x-adminlte-input>
                                </div>
                                {{-- jabatan --}}
                                <div class="col-md-6">
                                    <label for="jabatan">Jabatan</label>
                                    <x-adminlte-input name="jabatan" value="{{$user[0]->jabatan}}" readonly="true">
                                    </x-adminlte-input>
                                </div>
                                <div class="col-md-6">
                                    @php
                                    $options = ['Cuti Tahunan'=>'Cuti Tahunan','Cuti Sakit' => 'Cuti Sakit', 'Cuti
                                    Karena Alasan Penting' => 'Cuti Karena Alasan Penting', 'Keterangan Lain' =>
                                    'Keterangan Lain'];
                                    if (!empty(old('jenis_cuti'))) {
                                    $selected = [old('jenis_cuti')];
                                    }else{
                                    // $selected = [$user[0]->bagian];
                                    $selected = ['Cuti Tahunan'];
                                    }
                                    @endphp
                                    <x-adminlte-select name="jenis_cuti" label="Jenis Cuti">
                                        <x-adminlte-options :options="$options" :selected="$selected" />
                                    </x-adminlte-select>
                                </div>
                                <div class="col-md-6">
                                    @php
                                    $options = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6];
                                    if (!empty(old('hari'))) {
                                    $selected = [old('hari')];
                                    }else{
                                    // $selected = [$user[0]->bagian];
                                    $selected = [1];
                                    }
                                    @endphp
                                    <x-adminlte-select onchange="handleSelectChange();" id="hari" name="hari"
                                        label="Jumlah Hari">
                                        <x-adminlte-options :options="$options" :selected="$selected" />
                                    </x-adminlte-select>
                                </div>

                                {{-- dari --}}
                                <div class="col-md-6">
                                    <label for="tgl_cuti">Tanggal Cuti</label>
                                    <x-adminlte-input name="tgl_cuti" class="inputTgl">
                                    </x-adminlte-input>
                                </div>

                                {{-- sampai --}}
                                <div class="col-md-12">
                                    <label for="alamat">Alamat Selama Cuti</label>
                                    <x-adminlte-input name="alamat_cuti">
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-12 text-center">
                                    <x-adminlte-button class="btn-flat col-sm-2" type="submit" label="Submit"
                                        theme="success" icon="fas fa-lg fa-save" />
                                </div>



                            </div>
                        </x-adminlte-card>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@stop
@section('footer')
<div id="mycredit" class="small"><strong> Copyright &copy;
        <?php echo date('Y');?> Sistem Informasi Pengajuan Cuti Pegawai BLUD - Mufasirin
</div>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)

@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    function add() {
            window.location = "{{ route('cuti.create') }}";
        }

// Assuming initial setup with default range mode
let rangePicker = flatpickr(".inputTgl", {
    altInput: true,
    altFormat: "j F Y",
    dateFormat: "Y-m-d",
});

function handleSelectChange() {
    const selectedValue = parseInt($('#hari').val());

    if (selectedValue == 1) {
        // Switch to single mode
        rangePicker.destroy();
        rangePicker = null;
        
        rangePicker = flatpickr(".inputTgl", {
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
           
        });
    }else if (selectedValue > 1 && selectedValue <=6) {
        // Switch to single mode
        rangePicker.destroy();
        rangePicker = null;
        rangePicker = flatpickr(".inputTgl", {
            mode: 'range',
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
            const maxRange = selectedValue; // Get selected value from the select input
            const startDate = selectedDates[0];
            const endDate = selectedDates[1];

            if (startDate && endDate) {
                const diffTime = Math.abs(endDate - startDate) + 1;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                console.log(diffDays);
                if (diffDays != maxRange) {
                instance.clear(); // Clear the selection if range exceeds the limit
                Swal.fire({
                    type: 'warning',
                    title: 'Exceeded Maximum / Minimum Range',
                    text: `range allowed is ${maxRange} days.`,
                    confirmButtonText: 'OK'
                });
                }
            }
            }
        });
    } 
}
</script>
@stop