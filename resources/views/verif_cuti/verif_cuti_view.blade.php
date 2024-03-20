@extends('adminlte::page')

@section('title', 'Verifikasi Cuti')
@section('content_header')
    <h1>Verifikasi Cuti</h1>
@stop

@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive">

                                <table id="table_cuti" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Nama</th>
                                            <th>Jenis Cuti</th>
                                            <th>Tanggal Cuti</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($cuti as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td class="nama">{{ $data->name }}</td>
                                                <td>{{ $data->jenis_cuti }}</td>
                                                <td>{{ $data->tgl_cuti }}</td>
                                                <td>
                                                    @php
                                                        $dotColor = '';
                                                        switch ($data->status) {
                                                            case 'Pending':
                                                                $dotColor = 'yellow';
                                                                break;
                                                            case 'Batal':
                                                                $dotColor = 'red';
                                                                break;
                                                            case 'Ditolak':
                                                                $dotColor = 'red';
                                                                break;
                                                            case 'Disetujui':
                                                                $dotColor = 'green';
                                                                break;
                                                            default:
                                                                $dotColor = 'black'; // Default color
                                                                break;
                                                        }
                                                    @endphp
                                                    <span
                                                        style="display: inline-block; height: 10px; width: 10px; border-radius: 50%; background-color: {{ $dotColor }}; margin-right: 5px;"></span>
                                                    {{ $data->status }}
                                                </td>
                                                <td>

                                                    <button class="btn btn-info btn-show"
                                                        data-id_show="{{ $data->id }}">Lihat</button>
                                                    @if (empty($data->deleted_at) && $data->status == 'Pending')
                                                        <a class="btn btn-danger btn-delete"
                                                            data-id="{{ $data->id }}">Tolak</a>
                                                    @endif
                                                    @if (empty($data->deleted_at) && $data->status == 'Pending')
                                                        <a class="btn btn-success btn-setuju"
                                                            data-id="{{ $data->id }}">Setujui</a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            @stop
            @section('footer')
                <div id="mycredit" class="small"><strong> Copyright &copy;
                        <?php echo date('Y'); ?> Sistem Informasi Pengajuan Cuti Pegawai BLUD - Mufasirin </div>
            @stop

            @section('plugins.Datatables', true)
            @section('plugins.DatatablesPlugin', true)
            @section('plugins.Sweetalert2', true)

            @section('js')
                <script type="text/javascript">
                    function add() {
                        window.location = "{{ route('cuti.create') }}";
                    }
                    $(function() {
                        $("#table_cuti").DataTable({
                            "paging": true,
                            "lengthChange": false,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        })
                    });

                    $(document).on('click', '.btn-delete', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');

                        // Fetch CSRF token from the meta tag
                        var token = $('meta[name="csrf-token"]').attr('content');
                        let url = "/verifikasi/" + id;


                        Swal.fire({
                            title: 'Tolak Permintaan ?',
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya'
                        }).then((result) => {

                            if (result.value) {

                                Swal.fire({
                                    title: 'Alasan ditolak :',
                                    input: 'text',
                                    showCancelButton: true,
                                    confirmButtonText: 'Simpan',
                                    cancelButtonText: 'Batal',
                                    preConfirm: (value) => {
                                        if (!value.trim()) {
                                            Swal.showValidationMessage('Ketikan Alasan Penolakan');
                                        } else {
                                            return value;
                                        }
                                    }
                                }).then((result) => {
                                    if (result.value) {
                                        // Get the input value
                                        var id = $(this).data('id');
                                        const alasan = result.value;
                                        // Perform the AJAX request with the input value
                                        $.ajax({
                                            type: "PUT",
                                            url: "/verifikasi/" + id,
                                            data: {
                                                'id': id,
                                                'alasan': alasan,
                                                '_token': token,
                                            },
                                            success: function(data) {
                                                $.ajax({
                                                    type: "DELETE",
                                                    url: url,
                                                    data: {
                                                        '_token': token
                                                    },
                                                    success: function(data) {
                                                        Swal.fire({
                                                            title: 'Berhasil Ditolak!',
                                                            type: "success"
                                                        });
                                                        window.location.reload();
                                                    },
                                                    error: function(xhr, status, error) {
                                                        Swal.fire({
                                                            type: 'error',
                                                            title: 'Oops...',
                                                            text: error
                                                        });
                                                    }
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: error
                                                })
                                            }
                                        });

                                    }
                                });
                                //
                            }
                        });


                    });

                    $(document).on('click', '.btn-setuju', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var nama = $(this).parent().parent().find('.nama').text();
                        var token = $("meta[name='csrf-token']").attr("content");

                        Swal.fire({
                            title: 'Setujui Cuti ' + nama + ' ?',
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    type: "PUT",
                                    url: "/verifikasi/" + id,
                                    data: {
                                        'id': id,
                                        '_token': token,
                                    },
                                    success: function(data) {
                                        Swal.fire(
                                            'Berhasil!',
                                            'Cuti ' + nama + ' berhasil disetujui!',
                                            'success'
                                        )
                                        window.location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: error
                                        })
                                    }
                                });

                            }
                        })

                    });
                </script>
                <script>
                    $(document).on('click', '.btn-show', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id_show');

                        // Fetch CSRF token from the meta tag
                        var token = $('meta[name="csrf-token"]').attr('content');
                        let url = "/cuti/" + id;


                        $.ajax({
                            type: "GET",
                            url: url,

                            success: function(data) {
                                var cuti = data.cuti;

                                Swal.fire({
                                    title: 'Detail Cuti',
                                    html: `
                                        <table style="width:100%;text-align:left;">
                                            <tr>
                                                <th>NIP</th>
                                                <td>:</td>
                                                <td>${cuti[0].nip}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>${cuti[0].name}</td>
                                            </tr>
                                            <tr>
                                                <th>Bagian</th>
                                                <td>:</td>
                                                <td>${cuti[0].bagian}</td>
                                            </tr>
                                            <tr>
                                                <th>Jabatan</th>
                                                <td>:</td>
                                                <td>${cuti[0].jabatan}</td>
                                            </tr>
                                            <tr>
                                                <th>Pangkat</th>
                                                <td>:</td>
                                                <td>${cuti[0].pangkat}</td>
                                            </tr>
                                            <tr>
                                                <th>Diajukan Tgl</th>
                                                <td>:</td>
                                                <td>${cuti[0].created_at}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Cuti</th>
                                                <td>:</td>
                                                <td>${cuti[0].jenis_cuti}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Cuti</th>
                                                <td>:</td>
                                                <td>${cuti[0].tgl_cuti}</td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Hari</th>
                                                <td>:</td>
                                                <td>${cuti[0].hari} hari</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat Cuti</th>
                                                <td>:</td>
                                                <td>${cuti[0].alamat_cuti}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>:</td>
                                                <td>${cuti[0].status}</td>
                                            </tr>
                                            <tr>
                                                <th>Alasan</th>
                                                <td>:</td>
                                                <td>${cuti[0].alasan}</td>
                                            </tr>
                                            <tr>
                                                <th>Disetujui Oleh</th>
                                                <td>:</td>
                                                <td>${cuti[0].approve_by}</td>
                                            </tr>
                                            
                                        </table>
                                        `,
                                    showCloseButton: true,
                                    showConfirmButton: false
                                    // You can customize the modal further as needed
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: error
                                });
                            }
                        });
                    });
                </script>
            @stop
