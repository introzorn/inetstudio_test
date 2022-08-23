# Тестовое задание на позицию backend-разработчик

Необязательно решить всё правильно. Мы хотим понять, как Вы подходите к решению задач и пишете код, насколько хорошо разбираетесь в базовых принципах языка. 
Будьте готовы к обсуждению решений на собеседовании.

# Задачи на общий уровень владения языком
## ответом на каждую из задач должен быть код

Для всех заданий с массивами задан многомерный массив, элементы которого могут содержать одинаковые id:
```
$array = [
  [id => 1, date => "12.01.2020", name => "test1" ...],
  [id => 2, date => "02.05.2020", name => "test2" ...],
  [id => 4, date => "08.03.2020", name => "test4" ...],
  [id => 1, date => "22.01.2020", name => "test1" ...]
  [id => 2, date => "11.11.2020", name => "test4" ...],
  [id => 3, date => "06.06.2020", name => "test3" ...],
]
```

## Все решения постараться реализовать **НЕ** используя циклы _for / foreach_.

1. выделить уникальные записи (убрать дубли) в отдельный массив. 
в конечном массиве не должно быть элементов с одинаковым id.

На выходе:
```
$array = [
  [id => 1, ...],
  [id => 2, ...],
  [id => 4, ...],
  [id => 3, ...],
]
```

2. отсортировать многомерный массив по ключу (любому)

3. вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным `id`)

4. изменить в массиве значения и ключи (использовать `name => id` в качестве пары `ключ => значение`)

На выходе:
```
$array = [
  "test1" => 1,
  "test2" => 2,
  "test4" => 4,
  "test3" => 3
]
```

5. В базе данных имеется таблица с товарами `goods` (id INTEGER, name TEXT), 
таблица с тегами `tags` (id INTEGER, name TEXT) и таблица связи товаров и тегов 
`goods_tags` (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

На выходе: SQL-запрос.

6. Выбрать без join-ов и подзапросов все департаменты,
в которых есть мужчины, и все они (каждый) поставили высокую оценку (строго выше 5).
```
create table evaluations
(
    respondent_id uuid primary key, -- ID респондента
    department_id uuid,             -- ID департамента
    gender        boolean,          -- true — мужчина, false — женщина 
    value         integer	    -- Оценка
);
```
На выходе: SQL-запрос.

# Практические и архитектурные задачи
Решение должно быть "концептуально" правильным. Мы не будем досконально тестировать корректную работу системы на всех краевых случаях :)

1. Даны 2 класса. Один реализует поведение объектов, второй - сам объект.
Привести функцию `handleObjects` в соответствие с принципом открытости-закрытости (**O: Open-Closed Principle**) `SOLID`.
### (код представлен в папке `architecture`, в файле `solid_o.php`)

2. Устранить нарушения первого пункта принципа инверсии зависимостей (**D: Dependency Inversion Principle**) `SOLID`:
	« 1. Модули верхних уровней не должны зависеть от модулей нижних уровней. Оба типа модулей должны зависеть от абстракций. »
### (код представлен в папке `architecture`, в файле `solid_d.php`).

3. Имеется метод `getUserData`, который получает данные из внешнего API, передавая в запрос необходимые парамерты, вместе с ключом (**token**) идентификации.
Необходимо реализовать универсальное решение `getSecretKey()`, с использованием какого-либо шаблона (**pattern**) проектирования
для хранения этого ключа всевозможными способами: 
- in file
- in DB
- in server memоry (redis as example)
- in cloud 
- etc.

Достаточно реализовать простое решение, которое бы позволяло через параметр (в условной "глобальной конфигурации" / внутри класса данного метода), выбирать любой существующий способ хранения. 
Перечисленные способы хранения служат лишь примерами для глобального восприятия задачи и не обязательны к реализации, можно ограничиться заглушками.