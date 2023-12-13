@extends('adminlte::page')

@section('title','Pengajuan Cuti')
@section('content_header')
<h1>Pengajuan Cuti</h1>
@stop

@section('content')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row">

                    <div class="col-md-12">

                        <table id="table_siswa" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>

                        </table>


                    </div>
                </div>

            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            @stop
            @section('footer')
            <div id="mycredit" class="small"><strong> Copyright &copy;
                    <?php echo date('Y');?> Sistem Informasi Pengajuan Cuti Pegawai BLUD - Mufasirin </div>
            @stop

            @section('plugins.Datatables', true)
            @section('plugins.DatatablesPlugin', true)
            @section('plugins.Sweetalert2', true)

            @section('js')
            <script type="text/javascript">
                $(function () {
                    $("#table_siswa").DataTable({
                      "responsive": true, "lengthChange": false, "autoWidth": false,
                    //   "buttons": ["excel", "pdf", "print"],
                      "paging": true,
                      "lengthChange": false,
                      "searching": true,
                      "ordering": true,
                      "info": true,
                      "autoWidth": false,
                      "responsive": true,
                      "buttons": [
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3 ]
                                }
                            }
                        ]
                    }).buttons().container().appendTo('#table_siswa_wrapper .col-md-6:eq(0)');
                   
                  });
                
                  $(document).on('click', '.btn-delete', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var nama = $(this).parent().parent().find('.nama').text();
                    var token = $("meta[name='csrf-token']").attr("content");
                
                    Swal.fire({
                        title: 'Hapus data user '+nama+' ?',
                        text: "Semua data user akan hilang!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                             type: "DELETE",
                             url: "/user/"+id,
                             data: {
                                 'id'     :id,
                                 '_token' : token,
                                 },
                            success: function (data) {   
                                Swal.fire(
                                    'Deleted!',
                                    'Data user '+nama+' berhasil dihapus!',
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
            @stop