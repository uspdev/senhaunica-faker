# senhaunica-faker-laravel
Implementação mínima das respostas de OAuth1 usadas pelo [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite).

## Dependências
  * [uspdev/laravel-usp-theme](https://github.com/uspdev/laravel-usp-theme)

## Como rodar?
Basta seguir os procedimentos padrão:
  * Clonar;
  * Rodar o `composer install`;
  * Copiar o `.env.example` para `.env`;
  * Alterar o `APP_URL` para a URL correta. Ex: `http://127.0.0.1:3141`;
  * Daí basta configurar o servidor web ou rodar direto o `php artisan serve`.

Do lado do sistema que consumirá a autenticação falsa é necessário:
  * Usar o [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite);
  * No `.env`, configurar a variável `SENHAUNICA_DEV` com a URL do `APP_URL`, mas acrescentando `/wsusuario/oauth`. Ex: `http://127.0.0.1:3141/wsusuario/oauth`.
