Необходимые действия:
1) Указать в файле .env следующие настройки для базы данных\n
    DB_CONNECTION=mysql\n
    DB_HOST=db\n
    DB_PORT=3306\n
    DB_DATABASE=restapi\n
    DB_USERNAME=restapi_user\n
    DB_PASSWORD=password\n
    
2) docker compose build app

3) docker compose up -d

4) docker compose exec app chmod 777 -R .

5) docker compose exec app composer install 

6) docker compose exec app php artisan key:generate

7) docker compose exec app php artisan storage:link

8) docker compose exec app php artisan migrate

