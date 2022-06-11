# Repository_DataMapper
## Реализация паттерна Repository + DataMapper 

*Задача* Реализовать простое приложение PHP с доступом в одну из таблиц БД через паттерны Repository и Data Mapper.
Порядок выполнения:
1. Анализ задачи.
2. Исследование источников.
3. Реализовать преобразование данных таблицы в объект предметной области с помощью паттерна Data Mapper.
4. С помощью паттерна Repository реализовать функционал над одной таблицей БД по:
* получению всех записей
* получению записи по id
* получению записей по значению поля из таблицы (фильтрация по полю)
* сохранению записи
* удалению записи


Форма отчета: репозиторий на GitHub с php-приложением, работоспособное приложение доступное по сети, в котором в качестве DAL используются паттерны Repository и Data Mapper.

### Результат
[Чат](http://143.198.70.213:5555/)

### Архитектура папок:
![Архитектура](https://user-images.githubusercontent.com/91362737/173187173-0f334455-a0ba-47f6-80f8-5439b6250c84.png)

#### Паттерн Repository
Паттерн Repository посредничает между слоем области определения и слоем распределения данных, работая, как обычная колекция объектов области определения. Объекты-клиенты создают описание запроса декларативно и направляют их к объекту-репозиторию (Repository) для обработки. Объекты могут быть добавлены или удалены из репозитория, как будто они формируют простую коллекцию объектов. А код распределения данных, скрытый в объекте Repository, позаботится о соответсвующих операциях в незаметно для разработчика.
Реализован в ArchiveMes_Repository.php

#### Data Mapper
это паттерн, который выступает в роли посредника для двунаправленной передачи данных между постоянным хранилищем данных (часто, реляционной базы данных) и представления данных в памяти (слой домена, то что уже загружено и используется для логической обработки). Цель паттерна в том, чтобы держать представление данных в памяти и постоянное хранилище данных независимыми друг от друга и от самого преобразователя данных. 
Реализован в ArchiveMes_Mapper.php
