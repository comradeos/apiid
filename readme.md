# APIid
### Задание
```
Написать базовое API на php 8+ (входящие параметры POST, ответ json)

2 публичных метода

GET метод Генерация uuid с сохранением в базу. Ответ апи метода: uuid и его сгенерированный id
POST Получение uuid по его id
1 закрытый метод POST (по секретному http заголовку) - получение статистики сгенерированных uuid за период
для миграций в базу удобно использовать robmorgan/phinx
```

# Инструкция:
1. Установить Docker https://docs.docker.com/get-docker/
2. Открыть консоль, выполнить команды:  
   ```
   git clone https://github.com/comradeos/apiid.git
   ```
   
   ```
   cd apiid
   ```
   
   ```
   docker-compose up --build    
   ```
   
   Дождаться сборки и запуска проекта, о завершении процессов может свидетельствовать строчка:  
   
   ```
   apiid-db-1 | 2022-07-13T21:45:40.686547Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.29'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
   ``` 

4. Для импорта базы данных в браузере перейти по адресу http://127.0.0.1:82/ и выполнить вход:  
   ```
   System: MySQL  
   Server: db  
   Username: root  
   Password: root  
   Database: оставить пустым  
   ```
5. В браузере перейти по адресу http://127.0.0.1:82/?server=db&username=root&import=
6. Нажать "Choose Files", выбрать файл "db_backup.sql" (находится в папке "sources"), нажать "Execute"
7. Для создания новой базы данных, создать пустую бд с именем "apiid_db" и выполнить миграции:
   ### Для Docker на Windows/Mac  
   ```
   docker exec -it apiid-php-1 bash
   ```
   ```
   php ./vendor/bin/phinx migrate
   ```
   ### Для Docker на Linux
   ```
   sudo docker exec -it apiid_php_1 bash
   ```
   ```
   php ./vendor/bin/phinx migrate
   ```

8. Готово, адрес API http://127.0.0.1:81/

# Авто-тестирование:
### Если Docker установлен на Windows/MacOS:
Для автоматического тестирования выполните в консоли следующие команды:
```
docker exec -it apiid-php-1 bash
```
```
chmod 711 ./vendor/bin/phpunit
```
```
php ./vendor/bin/phpunit ./tests/TestRequest.php
```
### Если Docker установлен на Linux:
```
sudo docker exec -it apiid_php_1 bash
```
```
chmod 711 ./vendor/bin/phpunit
```
```
php ./vendor/bin/phpunit ./tests/TestRequest.php
```
# Ручное-тестирование:
Находятся во временном файле  
http://127.0.0.1:81/temp/requests.php





