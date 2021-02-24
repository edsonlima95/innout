@extends('web.layout_master')
@section('content')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fa fa-list-alt"></i> Lista de usuários</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{route('app.home')}}" class="btn btn-dark"><i class="fa fa-home mr-2"></i>Voltar</a>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-users"></i> Listagem</h3>
                <a href="{{route('app.users.create')}}" class="btn btn-success float-right"><i
                        class="fa fa-plus-circle mr-2"></i>Cadastrar</a>
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
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">#Codigo
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending">Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        E-mail
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Acesso
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Ações
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                    @foreach($users as $user)
                                        <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{$user->id}}</td>
                                            <td>{{$user->name ?? ''}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->is_admin ? 'Admin' : 'Usúario'}}</td>
                                            <td class="text-center">
                                                @if($user->id !== \Illuminate\Support\Facades\Auth::id())
                                                    <form action="{{route('app.users.destroy',['user'=>$user->id])}}" class="d-block" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        <a class="btn btn-primary" href="{{route('app.users.edit',['user'=>$user->id])}}"><i class="fa fa-edit"></i></a>
                                                    </form>
                                                @else
                                                    <a class="btn btn-primary" href="{{route('app.users.edit',['user'=>$user->id])}}"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1">{{$users->id}}</td>
                                        <td>{{$users->name}}</td>
                                        <td>{{$users->email}}</td>
                                        <td>{{$users->is_admin ? 'Admin' : 'Usúario'}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary"
                                               href="{{route('app.users.edit',['user'=>$users->id])}}"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
