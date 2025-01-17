@extends('layouts.customtheme')

@section('content')

<div class="animated fadeIn">
    <div class="card">

        <div class="col-md-12 text-right">
            <form action="{{ route('register') }}">
                <button type="submit" text-align="right" title="Daftar Pengguna" class="btn btn-primary btn-sm rounded">
                    <i class="fa fa-user"></i> Daftar Pengguna
                </button>
                <br />
            </form>
        </div>

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Senarai Pengguna Sistem</b></h3>
        </div>

        <div class="card-body">

            {{csrf_field()}}

            @if(session ('status'))
            <div class="alert alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Success</span>
                <b>{{ session ('status')}}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">Bil</th>
                        <th width="55%" style="text-align: center">Nama dan Jawatan</th>
                        <th width="20%" style="text-align: center">Maklumat</th>
                        <th width="20%" style="text-align: center">Tindakan</th>
                    </tr>
                </thead>

                @forelse($users as $counter => $user)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>

                    <td><strong>{{ $user->name }}</strong>
                        <small>, {{ $user->ic }}</small>
                        <br>
                        @if(!empty( $user->Unit->nama_unit))
                        <span>{{ $user->Unit->nama_unit }}</span>
                        @else
                        <span class="badge badge-danger">Tiada Maklumat</span>
                        @endif
                        <p>
                            {{-- <small><strong> Jenis Mesyuarat : </strong>
                                @forelse($user_tajuk_mesyuarat as $tajuk_mesyuarat)
                                @if($tajuk_mesyuarat->id_user == $user->id)
                                {{ $tajuk_mesyuarat->TajukMesyuarat->ringkasan }},
                                @endif
                                @empty
                                @endforelse
                            </small> --}}
                            {{-- <br> --}}
                            <small>{!! $user->email !!}</small>
                            <br>
                            <small> {!! $user->jawatan !!}</small>
                            <br>
                            <span>
                                <i class="ti ti-mobile"></i> &nbsp; {!! $user->no_telefon !!}
                            </span>
                        </p>
                    </td>

                    <td>
                        <table>
                            <tr style="background: none;">
                                <td style="border: none;"><strong> Peranan:</td></strong>
                                <td style="border: none;">
                                    @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                                    @if ($role_pengguna->id_user == $user->id)
                                    @if (in_array($role_pengguna->id_peranan, [1, 2]))
                                    <span>{{ $role_pengguna->Peranan->nama_peranan }}</span>
                                    @endif
                                    @endif
                                    @empty
                                    <span class="badge badge-dark">Tiada maklumat peranan</span>
                                    @endforelse
                                </td>
                            </tr>
                            <tr style="background: none;">
                                <td style="border: none;"><strong> Status:</td></strong>
                                <td style="border: none;">
                                    @if($user->status == 0)
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @elseif($user->status == 1)
                                    <span>Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td style="text-align: center">
                        <form action="{{ route('p_padamPengguna.softDelete',$user->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti untuk menghapuskan rekod ini?');" style="display: inline-block;">
                            @csrf

                            <!-- Papar Ahli -->
                            <!-- <a title="Papar Maklumat" class="btn btn-warning btn-sm rounded-circle" href="{{ route('p_paparPengguna.show',$user->id) }}">
                                <i class="fa fa-eye"></i></a> -->

                            <!-- Ubahsuai/ Kemaskini maklumat Ahli -->
                            <a title="Kemaskini" class="btn btn-warning btn-sm rounded-circle" href="{{ route('p_editPengguna.edit',$user->id) }}" alt="Edit"><i data-feather="Edit" alt="edit">
                                    <i class="fa fa-edit"></i></a>

                            <!-- Reset Password  -->
                            <a title="Reset Kata Laluan" class="btn btn-secondary btn-sm rounded-circle" href="{{ route('edit-password-pengguna-admin',$user->id) }}" alt="Reset Kata Laluan" data-original-title="Reset Kata Laluan"><i data-feather="lock" alt="edit">
                                    <i class="fa fa-lock"></i></a>

                            <!-- Padam Ahli -->
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button title="Padam" class="btn btn-danger btn-sm rounded-circle" type="submit" value=""><i class="fa fa-trash" data-feather="user-x" alt="Padam"></i></button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4">Tiada Rekod </td>
                </tr>
                @endforelse

            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable({
            "language": {
                "emptyTable": "Tiada data",
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
                    "sortAscending": ": diaktifkan kepada susunan lajur menaik",
                    "sortDescending": ": diaktifkan kepada susunan lajur menurun"
                },
                "autoFill": {
                    "cancel": "batal",
                    "fill": "Isi semua sel dengan <i>%d<\ /i>",
                    "fillHorizontal": "Isi sel secara mendatar",
                    "fillVertical": "Isi sel secara menegak"
                },
                "buttons": {
                    "collection": "Koleksi <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"> <\ / span > ",
                    "copy": "Salin"
                },
                "thousands": ",",

            }
        });
    });
</script>
@endsection
