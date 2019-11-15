## Sobre aplicação
É uma aplicação simples de crud de tarefas feita em Laravel com JQuery

## Funcionalidade e Recursos
- [x] Login com autenticação
- [x] Usuário default do sistema
- [x] Uso de um middleware para autenticação
- [x] Validação de dados no cadastro e no login
- [x] Cadastro de tarefas
- [x] Listagem de tarefas
- [x] Marcar as mensagens como realizadas
- [x] Deletar Tarefas

## Screenshots
![View Login](public/Screenshots_Readme/view_login.png?w=512)
![View Principal](public/Screenshots_Readme/view_tasks.png?w=512)

## Pre requisistos 

- PHP 7.2 +
- Node/NPM
- Composer
- Xamp/Wamp/Servidor Web


## Usage

1. Clone o projeto com git hub ou Download zip

* Rode os comandos os comandos abaixo no **terminal de sua preferência**, na **raiz do projeto**

2. Roda o composer install
```
    composer install
```

3. Roda o npm install e npm run dev
```
    npm install
    npm run dev
```

4. Faz a copia do arquivo **.env** com o comando abaixo ou manualmente.
```
    php -r "copy('.env.example', '.env');"
```

5. Altera as configurações do banco de dados de acordo com as suas configurações.

6. Gera a key (**php artisan key:generate**) 
```
    php artisan key:generate
```

7. Rode as migration
```
    php artisan migrate:fresh
```

8. Rode a seeder **UserSeeder**. Ela possui um usuário default (login: admin, senha: admin)
```
    php artisan db:seed --class=UserSeeder
```

9. Rode a aplicação
```
    php artisan serve
```

10. Acesse a rota **/login**

11. Acesse o **arquivo de rotas** para ter uma noção dos caminhos das rotas
      Path => **./routes/web.php**


## Tecnologias
- [PHP](https://www.php.net/manual/pt_BR/intro-whatis.php)
- [Javascript](https://developer.mozilla.org/pt-BR/docs/Aprender/JavaScript)
- [Laravel 6.5.1](https://laravel.com/)
- [JQuery 3.4.1](https://jquery.com/) 
- [Bootstrap 4.*](https://getbootstrap.com.br/docs/4.1/getting-started/introduction/)
- [MomentJS](https://momentjs.com/)
- [DateTimePicker](https://tempusdominus.github.io/bootstrap-4/)


	

