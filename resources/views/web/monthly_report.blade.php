@extends('web.layout_master')
@section('content')
    @section('breadcrumb')
        <div class="row mb-2">
            <div class="col-sm-6 mb-3">
                <h1 class="m-0 text-dark"><i class="fa fa-calendar-alt"></i> Relatório do mês: {{date('m/Y')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{route('app.home')}}" class="btn btn-dark col-lg-12 "><i class="fa fa-home mr-2"></i>Voltar</a>
                </ol>
            </div><!-- /.col -->
        </div>
    @endsection
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('app.month-report')}}" class="row" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6">
                            <label for="">Selecione um usuário</label>
                            <div class="input-group">
                                <select name="user_id" id="" class="form-control">
                                    <option value="" selected disabled>Selecionar</option>
                                    <option value="1">Admin</option>
                                    <option value="2">João</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Selecione um mês</label>
                            <div class="input-group">
                                <input type="month" name="date" id="" class="form-control">
                                <button type="submit" class="ml-2 btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
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
                                            <td><span
                                                    class="badge {{$report->worked_time >= 28800 ? 'badge-success' : 'badge-danger'}}">{{$report->dayBalance()}}</span>
                                            </td>
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
                            <th rowspan="1" colspan="2" class="text-center"><span
                                    class="badge {{$sign == '+' ? 'badge-success' : 'badge-danger'}}  ">{{$balance}}</span>
                            </th>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
