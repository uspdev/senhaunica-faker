@extends ('laravel-usp-theme::master')

@section ('title') Senhaunica Faker @endsection

@section ('content')
<div class="panel">
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
@endsection

@section ('footer') @endsection
