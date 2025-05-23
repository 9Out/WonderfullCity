@extends('admin.layouts/adminlayout')

@section('title', 'Wisata')

@push('links')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')

<h1>Data Wisata</h1>
<div class="aksi">
    <a href="{{ route('wisata.create') }}" class="button button-blue"><i class="fa-regular fa-square-plus"></i>Tambah Wisata</a>
</div>

@include('admin.components.success')
@include('admin.components.error')
    
<table id="items-table" class="display" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nama Wisata</th>
            <th>Jumlah Foto</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th class="foot">#</th>
            <th class="foot">Foto</th>
            <th class="foot">Nama Wisata</th>
            <th class="foot">Jumlah Foto</th>
            <th class="foot">Tanggal Dibuat</th>
            <th class="foot">Aksi</th>
        </tr>
    </tfoot>
</table>

@endsection

@section('content-js')
    @parent
    <!-- jQuery HARUS di atas semuanya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Baru DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("wisata.admin") }}',
                language: {
                    emptyTable: "Tidak ada data tersedia",
                    processing: "<i class='fa fa-refresh fa-spin'></i> Memuat..."
                },
                columns: [
                    { 
                        data: null, 
                        name: 'index',
                        orderable: false, 
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'foto_utama',
                        name: 'foto_utama',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'nama_wisata', name: 'nama_wisata' },
                    {
                        data: 'jumlah_foto',
                        name: 'jumlah_foto',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [
                    { targets: [0], width: '4%' },
                    { targets: [1], width: '9%' },
                    { targets: [2], width: '32%' },
                    { targets: [3], width: '11%' },
                    { targets: [4], width: '13%' },
                    { targets: [5], width: '25%' },
                    {
                        targets: [0],
                        className: 'dt-body-center',
                        createdCell: function (td) {
                            $(td).css('padding', '10px 4px')
                        }
                    },
                    {
                        targets: [1, 2],
                        className: 'dt-body-left',
                        createdCell: function (td) {
                            $(td).css('padding', '10px 18px')
                        }
                    },
                    {
                        targets: [3, 4],
                        className: 'dt-body-center',
                        createdCell: function (td) {
                            $(td).css('padding', '10px 18px')
                        }
                    },
                    {
                        targets: [5],
                        className: 'dt-body-center',
                        createdCell: function (td) {
                            $(td).css('padding', '0')
                        }
                    }
                ],
                order: [[4, 'desc']]
            });

            $('.dataTables_wrapper').css({
                'margin': '20px auto',
                'padding': '10px 10px 4px',
                'background-color': '#fff',
                'border': '1px solid #ddd',
                'border-radius': '8px'
            });
        });
    </script>
@endsection