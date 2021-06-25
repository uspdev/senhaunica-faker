@extends ('laravel-usp-theme::master')

@section ('title') Senhaunica Faker @endsection

@section('skin_login_bar')
  {{-- removendo o conteúdo do login_bar --}}
  &nbsp;
@endsection

@section ('content')

<div class="row">
    <div class="col-md-7">
    Utilize os códigos abaixo para simular login de diversos tipos de usuários.
    <ul>
        <li>100XX: Servidor não-docente;</li>
        <li>200XX: Docente;</li>
        <li>400XX: Estagiário;</li>
        <li>800XX: Aluno de Pós-graduação;</li>
        <li>1600XX: Aluno de Graduação.</li>
    </ul>

    X pode ser qualquer número de 00 a 99. Você pode combinar o prefixo para que seja devolvido mais de um vínculo. Por exemplo:
    <ul>
        <li>1700XX: Servidor não-docente e aluno de Graduação;</li>
        <li>2000XX: Estagiário e aluno de Graduação.</li>
    </ul>
    </div>
    <div class="col-md-5">
        <div class="jumbotron py-4" style="width:350px;">
            <form class="login-form" method="POST" action="wsusuario/oauth/authorize">
                @csrf
                <div class="form-group">
                    <label class="control-label" for="callback">Callback</label>
                    <input class="form-control" type="text" id="callback" name="callback" value="{{ old('callback') ?? $referer.'callback' }}" {{ $disabled }} required />
                </div>
                <div class="form-group">
                    <label class="control-label" for="loginUsuario">Usuário</label>
                    <input class="form-control" type="text" id="loginUsuario" name="loginUsuario" value="{{ old('loginUsuario') ?? '' }}" {{ $disabled }} required autofocus />
                </div>
                <input type="hidden" id="oauth_token" name="oauth_token" value="{{ $oauth_token }}" />
                <input type="hidden" id="callback_id" name="callback_id" value="{{ $callback_id }}" />
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" {{ $disabled }}>Login</button>
                </div> 

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </form>

        </div>
    </div>
</div>
@endsection

@section ('footer') @endsection
