@extends('web.layout_master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Relatório mensal</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data-table" class="table table-bordered table-striped dataTable dtr-inline"
                                       role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                            aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">#Codigo
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Dia Útil
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">
                                            1 Entrada
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            1 Saida
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            2 Entrada
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            2 Saida
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                            Saldo
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthReport  as $report)
                                        <tr role="row" class="odd">
                                            <td>{{$report->id}}</td>
                                            <td tabindex="0"
                                                class="sorting_1">{{date('d/m/Y',strtotime($report->work_date))}}</td>
                                            <td>{{$report->time_1}}</td>
                                            <td>{{$report->time_2}}</td>
                                            <td>{{$report->time_3}}</td>
                                            <td>{{$report->time_4}}</td>
                                            <td><span class="badge {{$report->worked_time >= 28800 ? 'badge-success' : 'badge-danger'}}">{{$report->dayBalance()}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table">
                    <tr>
                        <th rowspan="1" colspan="2">Horas Trabalhadas</th>
                        <th rowspan="1" colspan="2">{{convertTimeToHour($sumWorkedTime)}}s</th>
                        <th rowspan="1" colspan="2">Saldo Mensal</th>
                        <th rowspan="1" colspan="2" class="text-center"><span class="badge {{$sign == '+' ? 'badge-success' : 'badge-danger'}}  ">{{$balance}}</span></th>
                    </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
