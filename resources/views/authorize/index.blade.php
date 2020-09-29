@extends ('laravel-usp-theme::master')

@section ('title') Senhaunica Faker @endsection

@section ('content')

<div class="row">
    <div class="column ml-5 mr-5">
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
    <div class="column jumbotron">
        <form class="login-form" method="POST" action="/wsusuario/oauth/authorize">
            <div class="form-group">
                <label class="control-label" for="callback">Callback</label>
                <input class="form-control" type="text" id="callback" name="callback" placeholder="http://localhost:80/callback" />
            </div>
            <div class="form-group">
                <label class="control-label" for="loginUsuario">Usuário</label>
                <input class="form-control" type="text" id="loginUsuario" name="loginUsuario" />
            </div>
            <input type="hidden" id="oauth_token" name="oauth_token" value="{{ $oauth_token }}" />
            <input type="hidden" id="callback_id" name="callback_id" value="{{ $callback_id }}" />
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Login</button>
            </div> 
        </form>
    </div>
</div>
@endsection

@section ('footer') @endsection
