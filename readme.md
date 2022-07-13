# APIid
Php 8+ BaseAPI, 2 public methods: 1. GET (generates uuid and saves to database), 2. POST (get uuid by id), 1 private POST (get statistics by time period, secret http header protected)

# Инструкция:
1. Установить Docker
2. Стянуть проект с репозитория
3. В консоли перейти в папку проекта и выполнить docker-compose up --build
4. В браузере перейти по адресу http://127.0.0.1:82/ и выполнить вход:
System: MySQL
Server: db
Username: root
Password: root
Database: оставить пустым
5. В браузере перейти по адресу http://127.0.0.1:82/?server=db&username=root&import=
6. Нажать "Choose Files", выбрать файл "db_backup.sql", нажать "Execute"
7. Готово, адрес API http://127.0.0.1:82/

# Авто-тестирование:
Для автоматического тестирования выполните в консоли следующие команды:
1.  docker exec -it apiid-php-1 bash
2. ./vendor/bin/phpunit ./tests/TestRequest.php








