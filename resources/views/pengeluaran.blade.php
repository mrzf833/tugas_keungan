@component('layouts.template.layout')
    @slot('css')
        <!-- Custom styles for this page -->
        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endslot
    @slot('header')
        Pengeluaran
    @endslot
    @slot('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Pengeluaran</h6>
                        <button class="btn btn-primary float-right d-inline-block" data-target="#create" data-toggle="modal">Create</button>
                        <button class="btn btn-danger float-right d-inline-block mr-2" data-target="#delete-all" data-toggle="modal">Delete All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Uang</th>
                                        <th>Di buat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Pengeluaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengeluaran.store') }}" method="post">
                            @csrf
                            <input type="number" min="10000" name="uang" id="" class="form-control" required placeholder="uang tanpa titik atau pun koma">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Pengeluaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            Apakah Anda Yakin Akan Menghapus Data Ini
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('pengeluaran.index') }}" method="post" id="formDelete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete All Pengeluaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            Apakah Anda Yakin Akan Menghapus Semua Data Ini
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('pengeluaran.delete.all') }}" method="post" id="formDelete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endslot
    @slot('script')
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script>
            // Call the dataTables jQuery plugin
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('pengeluaran.index') }}",
                    },
                    order : [[1,'desc']],
                    columns: [
                        {
                            data: 'nilai',
                            name: 'nilai',
                            // orderable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data,type,full,meta){
                                const date = new Date(data)
                                var tahun = date.getFullYear();
                                var bulan = date.getMonth();
                                bulan = Number(bulan) + 1;
                                var tanggal = date.getDate();
                                var jam = date.getHours();
                                var menit = date.getMinutes();
                                var detik = date.getSeconds();
                                return ( tanggal < 10 ? '0' + tanggal : tanggal ) + '-' + ( bulan < 10 ? '0' + bulan : bulan ) + '-' + tahun + ' ' + jam + ':' + menit + ':' + detik;
                            },
                            // orderable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        }
                    ]
                });
            });
        </script>
        <script>
            $(document).on('click','.delete',function(){
                let form = $('#formDelete')
                let id = $(this).attr('data')
                let action = "{{ route('pengeluaran.index') }}"
                form.attr('action', action + '/' + id)
            })
        </script>
    @endslot
@endcomponent