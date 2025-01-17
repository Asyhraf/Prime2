@extends('layouts.customtheme')
@section('content')

<!-- Container-fluid starts-->
<div class="container-fluid p-0">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Log Login</b></h3>
        </div>

        <div class="card-body">
            <div class="range-date b-grey">
                <form class="form-inline theme-form" action="{{ route('log-login')}}">
                    <div class="form-group mb-0">
                        <label for="tarikh_mula" class="pr-2">Tarikh Mula: </label>
                        <input class="form-control" type="date" name="tarikh_mula">
                    </div>
                    <div class="form-group mb-0 pl-2">
                        <label for="tarikh_akhir" class="pr-2">Hingga: </label>
                        <input class="form-control" type="date" name="tarikh_akhir">
                    </div>
                    <div class="form-group mb-0 pl-2">
                        <label for="tarikh_akhir" class="pr-2">Unit: </label>
                        <select class="form-control" name="unit" id="unit">
                            <option value="0">Semua</option>
                            @forelse($unit as $counter => $data)
                            <option value="{{ $data->id_unit }}">{{ $data->nama_unit }}</option>
                            @empty
                            <option value="0"></option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group mb-0 pl-2">
                        <button class="btn btn-primary btn rounded" name="papar" value="papar">Papar</button>
                    </div>
                    <div class="form-group mb-0 mt-3 tarikh">
                        @if($tarikh1 == null)
                        @else
                        Tarikh Mula: <b>{{date('d/m/Y', strtotime($tarikh1))}}</b> &nbsp; hingga: <b>{{date('d/m/Y', strtotime($tarikh2))}}</b> &nbsp;
                        Unit:
                        @if($unit_req == null)
                        <b>Semua unit</b>
                        @else()
                        <b>{{ $unit_req }}</b>  <br>
                        @endif
                        @endif
                    </div>
                </form>
            </div>

            <div class="table-responsive b-grey">
                <table class="table table-striped table-bordered" id="bootstrap-data-table-export">
                    <thead>
                        <tr>
                            <th width="5%" style=" text-align: center">Bil</th>
                            <th width="35%" style="text-align: center">User</th>
                            <th width="30%" style="text-align: center">Login IP</th>
                            <th width="30%" style="text-align: center">Log Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($log as $counter => $data_log)
                        <tr>
                            <?php $counter++; ?>
                            <td style='text-align:center'>{{ $counter }}</td>
                            <td>
                                {{ $data_log->User->name }}
                            </td>
                            <td>
                                {{ $data_log->login_ip }}
                            </td>
                            <td>
                                Tarikh: {{date('d/m/Y', strtotime($data_log->login_at))}}, {{ date('h:i A', strtotime($data_log->login_at)) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="{{ asset('landpage/vendors/jquery/dist/jquery.min.js') }}"></script> -->

<!-- <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script> -->

<!-- <script type="text/javascript" src="{{ asset('landpage/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script> -->

<script>
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable({
            "language": {
                "emptyTable": "Tiada data tersedia dalam jadual",
                "info": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
                "infoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
                "infoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
                "infoThousands": ",",
                "lengthMenu": "Papar _MENU_ rekod",
                "loadingRecords": "Diproses...",
                "processing": "Sedang diproses...",
                "search": "Carian:",
                "zeroRecords": "Tiada padanan rekod yang dijumpai.",
                "paginate": {
                    "first": "Pertama",
                    "previous": "Sebelum",
                    "next": "Seterusnya",
                    "last": "Akhir"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk menyusun lajur menaik",
                    "sortDescending": ": aktifkan untuk menyusun lajur menurun"
                },
                "autoFill": {
                    "cancel": "Batal",
                    "fill": "Isi semua sel dengan <i>%d</i>",
                    "fillHorizontal": "Isi sel secara mendatar",
                    "fillVertical": "Isi sel secara menegak"
                },
                "buttons": {
                    "collection": "Koleksi <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"></span>",
                    "copy": "Salin",
                    "print": "Cetak",
                    "colvis": "Lajur Terlihat"
                },
                "select": {
                    "rows": {
                        "_": "%d baris dipilih",
                        "0": "Tiada baris dipilih",
                        "1": "1 baris dipilih"
                    }
                }
            }
        });
    });
</script>

@endsection
