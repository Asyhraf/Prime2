@extends('layouts.customtheme')

@section('content')


@if($ref_tajuk_mesyuarat -> isEmpty())
<p>Tiada Maklumat</p>
@else

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <br />
                <h1 class="p-3 mb-2 bg-dark text-center text-white"><i>Cetakan Kawalan Dokumen</i></h1>

                <br />

                <div class="card">
                    <div class="card-body">

                        <body>
                            {{csrf_field()}}
                            @foreach($errors ->all() as $errors)
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ $errors }}</li>
                                </ul>
                            </div>
                            @endforeach
                            @if(session ('status'))
                            <div class="alert alert-sucess">
                                <b>{{ session ('status')}}</b>
                            </div>
                            @endif
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr style="background-color:#212F3D">
                                        <th width="5%" style="text-align: center">
                                            <font color="#FFFFFF">Bil</font>
                                        </th>
                                        <th width="50%" style="text-align: center">
                                            <font color="#FFFFFF">Nama Mesyuarat</font>
                                        </th>
                                        <th width="5%" style="text-align: center">
                                            <font color="#FFFFFF">Ringkasan Nama Mesyuarat</font>
                                        </th>
                                        <th width="5%" style="text-align: center">
                                            <font color="#FFFFFF">Tarikh Surat</font>
                                        </th>
                                        <th width="5%" style="text-align: center">
                                            <font color="#FFFFFF">Bilangan Rujukan</font>
                                        </th>
                                        <th width="5%" style="text-align: center">
                                            <font color="#FFFFFF">Cetak</font>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($ref_tajuk_mesyuarat as $counter => $mesyuarat)
                                    <?php $counter++; ?>
                                    <tr>
                                        <td align="center">{{ $counter }}</td>

                                        <td><strong>{{ $mesyuarat->nama_tajuk }}</strong><br>

                                        <td align="center"><strong>{{ $mesyuarat->ringkasan }}</strong><br>


                                        <td align="center"><strong>
                                                <div class="form-group">
                                                    <input class="form-control" name="tarikhSurat" type="date" cols="5" rows="5" value=""></inpput>
                                                </div>
                                            </strong><br>


                                        <td align="center"><strong>
                                                <div class="form-group">
                                                    <input class="form-control" name="bilRujukan" id="" cols="5" rows="5" value=""></input>
                                                </div>
                                                </form>
                                            </strong><br>




                                        <td align="center">
                                            <a title="Cetak Senarai Ahli Mesyuarat {{ $mesyuarat->ringkasan }}" class="btn btn-success btn-sm rounded-circle" onclick="window.location.href='{{ route("penyelenggaraanKD", ["p_CetakanKawalanDokumen2",$mesyuarat->id_tajuk]) }}'">
                                                <i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @empty
                                <tr>
                                    <td colspan="3">Tiada Rekod </td>
                                </tr>
                                @endforelse

                            </table>
                        </body>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @endsection