
# Secto Teca


Instruções para Iniciar a Aplicação

Este guia fornece instruções passo a passo para configurar e iniciar a aplicação Laravel. Certifique-se de seguir cada etapa cuidadosamente.

Pré-requisitos
Antes de começar, certifique-se de ter o Docker instalado em sua máquina.

1. Configure o arquivo .env

Crie um arquivo .env na raiz do seu projeto e configure as informações do banco de dados conforme o exemplo abaixo:

```env
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=laravel_db
DB_USERNAME=postgres
DB_PASSWORD=secret
```

2. Execute o Docker Compose

Abra o terminal na raiz do seu projeto e execute o seguinte comando para iniciar os contêineres Docker:

```
docker compose up -d
```
Nota: Certifique-se de que a porta 5432 está livre. Caso esteja em uso, pare a aplicação que a utiliza, libere a porta e execute novamente o Docker Compose.

3. Execute as Migrações

Com o contêiner em execução, execute as migrações para criar o banco de dados:

```
php artisan migrate
```


4. Inicie o Servidor de Desenvolvimento

Inicie o servidor de desenvolvimento Laravel com o seguinte comando:

```
php artisan serve
```


Agora sua aplicação Laravel deve estar acessível em http://localhost:8000.

Lembre-se de ajustar as configurações conforme necessário e siga o guia para personalizar ainda mais sua aplicação Laravel.

