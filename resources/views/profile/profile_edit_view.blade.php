@extends('adminlte::page')

@section('title','Kelola Profil')
@section('content_header')
<h1>Ubah Profil</h1>
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
                <form method="POST" action="{{ route('profile.update', $profile[0]->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <x-adminlte-card title="Ubah Profil" theme="dark" icon="fas fa-lg fa-portrait">
                                <img id="image_profile" src="{{asset('storage/images/'.$profile[0]->image)}}"
                                    alt="foto profile" class="rounded mx-auto d-block mt-2">
                                <x-adminlte-input-file id="imgInp" name="image" label="Foto Profil"
                                    placeholder="Unggah Gambar...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-file>
                                <x-adminlte-input name="nip" label="NIP / NIPB" placeholder="NIP / NIPB"
                                    value="{{old('nip') ? old('nip') : $profile[0]->nip}}" />
                                <x-adminlte-input name="name" label="Nama" placeholder="Nama"
                                    value="{{old('name') ? old('name') : $profile[0]->name }}" />
                                @php
                                $options = [
                                    'Sub Bagian Perencanaan dan Keuangaan'=>'Sub Bagian Perencanaan dan Keuangaan',
                                    'Seksi Pelayanan Medis' => 'Seksi Pelayanan Medis', 
                                    'Sub Bagian Umum dan Kepegawaian' => 'Sub Bagian Umum dan Kepegawaian',
                                    'Seksi Pelayanan Keperawatan' => 'Seksi Pelayanan Keperawatan', 
                                    'Seksi Pelayanan Penunjang Medis' => 'Seksi Pelayanan Penunjang Medis', 
                                    'Seksi Pelayanan Penunjang Non Medis' => 'Seksi Pelayanan Penunjang Non Medis']; 
                                if (!empty(old('bagian'))) {
                                $selected = [old('bagian')];
                                }else{
                                $selected = [$profile[0]->bagian];
                                }
                                @endphp
                                <x-adminlte-select name="bagian" label="Satuan / Bagian">
                                    <x-adminlte-options :options="$options" :selected="$selected" />
                                </x-adminlte-select>
                                <x-adminlte-input name="pangkat" label="Pangkat/Gol. Ruang" placeholder="Pangkat"
                                    value="{{old('pangkat') ? old('pangkat') : $profile[0]->pangkat}}" />
                                <x-adminlte-input name="jabatan" label="Jabatan" placeholder="Jabatan"
                                    value="{{old('jabatan') ? old('jabatan') : $profile[0]->jabatan}}" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-adminlte-input-file id="imgInpTtd" label="Tanda Tangan" name="ttd"
                                            placeholder="Unggah Gambar...">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text bg-lightblue">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input-file>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="image_ttd" src="{{asset('storage/ttd/'.$profile[0]->ttd)}}"
                                            alt="Tanda Tangan" class="rounded mx-auto d-block mt-2" width="200px">
                                    </div>
                                </div>

                                <div class="row p-4">
                                    <div class="col-sm-12 text-center">
                                        <x-adminlte-button class="btn-flat col-sm-4" type="submit" label="Simpan"
                                            theme="success" icon="fas fa-lg fa-save" />
                                    </div>
                                </div>

                            </x-adminlte-card>
                        </div>
                    </div>
                </form>

            </div><!-- /.container-fluid -->
        </main>
    </div>
</div>
<!-- /.content -->
@stop

@section('footer')
<div id="mycredit" class="small"><strong> Copyright &copy;
        <?php echo date('Y');?> Sistem Informasi Pengajuan Cuti Pegawai BLUD - Mufasirin </div>
@stop


@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.bsCustomFileInput', true)


@section('js')
<script type="text/javascript">
    imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    image_profile.src = URL.createObjectURL(file)
                }
    }
    // ttd
    imgInpTtd.onchange = evt => {
                const [file] = imgInpTtd.files
                if (file) {
                    image_ttd.src = URL.createObjectURL(file)
                }
    }
    $(document).ready(function() {
    $('#bagian').on('click', function() {
        // Check if the selected option is not the default "Select an option"
        if ($(this).val() === '-') {
            $(this).find('option[value="-"]').remove(); 
        }
    });
});

</script>
@stop