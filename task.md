Написать базовое API на php 8+ (входящие параметры POST, ответ json)  

2 публичных метода  
1. GET метод Генерация uuid с сохранением в базу. Ответ апи метода: uuid и его сгенерированный id  
2. POST Получение uuid по его id  
1 закрытый метод POST (по секретному http заголовку) - получение статистики сгенерированных uuid за период  
      
для миграций в базу удобно использовать robmorgan/phinx  