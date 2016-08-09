@extends('auth.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>Next</b>Inn</a>
        </div><!-- /.login-logo -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Opa!</strong> Foram encontrados alguns erros.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-box-body">
    <p class="login-box-msg">Preencha as informações abaixo para entrar na NextInn</p>
    <form action="{{ url('/auth/login') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> Me lembre
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
            </div><!-- /.col -->
        </div>
    </form>

    <div class="social-auth-links text-center">
        <p>- OU -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Logar usando o Facebook</a>
    </div><!-- /.social-auth-links -->

    <a href="{{ url('/password/email') }}">Eu esqueci minha Senha</a><br>
    <a href="{{ url('/auth/register') }}" class="text-center">Desejo me cadastrar</a>

</div><!-- /.login-box-body -->

</div><!-- /.login-box -->

    @include('auth.scripts')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
