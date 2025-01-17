@extends('layouts.customtheme')

@section('content')

<div class="container-fluid p-0">
    <div class="card">

        <div class="card-header">
            <h3 class="text-center text-uppercase"><b>Log Aktiviti</b></h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="bootstrap-data-table-export">
                    <thead>
                        <tr>
                            <th width="5%;" style="text-align: center">Bil</th>
                            <th width="30%;" style="text-align: center">Module</th>
                            <th width="30%;" style="text-align: center">Action</th>
                            <th width="35%;" style="text-align: center">Action Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($log as $counter => $data_log)
                        <tr>
                            <?php $counter++; ?>
                            <td style='text-align:center'>{{ $counter }}</td>
                            <td>
                                <div class="module">
                                    Module: {{$data_log->module_type}}, Id: {{$data_log->module_id}}
                                </div>
                            </td>
                            <td>
                                <div class="action">
                                    {{$data_log->action}}
                                </div>
                            </td>
                            <td>
                                <div class="action-data">
                                    {{$data_log->action_name}}, {{date('d/m/Y', strtotime($data_log->action_time))}}, {{ date('h:i A', strtotime($data_log->action_time)) }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
