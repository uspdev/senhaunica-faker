# senhaunica-faker-laravel

Implementação mínima das respostas de OAuth1 usadas pelo [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite).

# Usando em outro sistema

Basta subir na sua máquina um container apontando para a imagem do senhaunica-faker:

    docker run --rm \
      -p 3141:80 \
      --env "APP_URL=http://127.0.0.1:3141" \
      --env "APP_KEY=base64:hFCIxDuhMowTmnPENgqjXXOPcoJnC777ZBkEIy25t6o=" \
      uspdev/senhaunica-faker


## Como desenvolver com docker

Build:
  * Clonar;
  * cp .env.example .env;
  * `docker build -t faker .` (o ponto indica que o Dockerfile se encontra no diretório corrente)

Rodar a imagem do build como container:

    docker run --rm \
      -p 3141:80 \
      --env "APP_URL=127.0.0.1:3141" \
      --env "APP_KEY=base64:hFCIxDuhMowTmnPENgqjXXOPcoJnC777ZBkEIy25t6o=" \
      --name faker faker

## Como rodar sem docker?

Basta seguir os procedimentos padrão:
  * Clonar;
  * Rodar o `composer install --no-dev`;
  * Copiar o `.env.example` para `.env`;
  * Gerar a chave: `php artisan key:generate`;
  * Alterar o `APP_URL` para a URL correta. Ex: `http://127.0.0.1:3141`;
  * Daí basta configurar o servidor web ou rodar direto o `php artisan serve --port 3141`.

Do lado do sistema que consumirá a autenticação falsa é necessário:
  * Usar o [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite);
  * No `.env`, configurar a variável `SENHAUNICA_DEV` com a URL do `APP_URL`, mas acrescentando `/wsusuario/oauth`. Ex: 
  
```
  SENHAUNICA_DEV=http://127.0.0.1:3141/wsusuario/oauth
```
## Configuração (opcional)
  
Caso você necessite especificar uma lista de logins (números USP) associando-os a um ou mais vínculos, você pode utilizar as variáveis abaixo no arquivo `.env`:
  
```
FAKER_SERVIDOR=111111,222222
FAKER_DOCENTE=333333
FAKER_ESTAGIARIORH=444444
FAKER_ALUNOGR=555555
FAKER_ALUNOPOS=666666  
```

É possível também definir as informações da unidade no `.env`:

```
FAKER_CODIGO_UNIDADE=
FAKER_SIGLA_UNIDADE=
FAKER_NOME_UNIDADE=
```

## Atualização

Com a utilização do pacote `lucascudo/laravel-pt-br-localization` em dev, caso ele seja atualizado pelo composer, deve-se publicar novamente os seus arquivos com:

    php artisan vendor:publish --tag=laravel-pt-br-localization
