# Задача

Обратная связь, feedback

реализовать api метод создания сущности feedback

предполагается что api методу будет отправлен json с 2мя свойствами name и phone

их нужно валидировать:
- name не пустая строка и до 255 символов, 
- телефон только из цифр

так же у feedback должна быть 
- отметка времени создания, 
- ip адрес из рекваста

реализовать api метод получения всех feedback 
в которых будет только name, phone и время создания

# Запуск проекта

## База данных

> cd api

> php bin/console doctrine:database:create

> php bin/console doctrine:migrations:migrate

Создаётся база данных sqlite с таблицей Feedback

## Запуск сервера API

Из той же папки /api

> symfony serve
