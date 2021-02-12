<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(mix('frontend/assets/css/fontawesome/css/all.min.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('frontend/assets/css/adminlte.min.css'))}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @notifyCss
    <title>Login | Sistema de ponto</title>
</head>
<body class="hold-transition login-page">
@include('notify::messages')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html">In <b> n</b> Out</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Entre com seu e-mail e senha</p>

            <form action="{{route('app.dologin')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" value="{{old('email')}}" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" value="{{old('password')}}" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>
                <div class="input-group">
                    <button type="submit" class="btn btn-success col-12">Entrar</button>
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">Esqueci a senha</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->


<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/adminlte.min.js')}}"></script>
@notifyJs
</body>
</html>
