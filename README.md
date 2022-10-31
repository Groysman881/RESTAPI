Необходимые действия:
1) Указать в файле .env следующие настройки для базы данных
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=restapi
    DB_USERNAME=restapi_user
    DB_PASSWORD=password
    
2) docker compose build app

3) docker compose up -d

4) docker compose exec app chmod 777 -R .

5) docker compose exec app composer install

6) docker compose exec app php artisan 

7) docker compose exec app php artisan key:generate

8) docker compose exec app php artisan storage:link

9) docker compose exec app php artisan migrate

