# APIid
Php 8+ BaseAPI, 2 public methods: 1. GET (generates uuid and saves to database), 2. POST (get uuid by id), 1 private POST (get statistics by time period, secret http header protected)

# Инструкция:
1. Установить Docker https://docs.docker.com/get-docker/
2. Открыть консоль, выполнить команды:  
   ```
   git clone https://github.com/comradeos/apiid.git
   cd apiid
   docker-compose up --build    
   ```
   Дождаться сборки и запуска проекта, о завершении процессов может свидетельствовать строчка:  
   ```
   apiid-db-1 | 2022-07-13T21:45:40.686547Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.29'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
   ``` 
4. В браузере перейти по адресу http://127.0.0.1:82/ и выполнить вход:  
   ```
   System: MySQL  
   Server: db  
   Username: root  
   Password: root  
   Database: оставить пустым  
   ```
5. В браузере перейти по адресу http://127.0.0.1:82/?server=db&username=root&import=
6. Нажать "Choose Files", выбрать файл "db_backup.sql", нажать "Execute"
7. Готово, адрес API http://127.0.0.1:81/

# Авто-тестирование:
Для автоматического тестирования выполните в консоли следующие команды:
```
docker exec -it apiid-php-1 bash
chmod 711 ./vendor/bin/phpunit
php ./vendor/bin/phpunit ./tests/TestRequest.php
```







