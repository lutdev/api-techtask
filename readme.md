# Задание
-  Реализовать подключение к 2 API и агрегацию данных в БД(MySQL)
-  Построить RESTful API Вашей системы для получения сохранённых данных в БД
   - получение ID офферов (с выборкой по status, country, currency, advertiser, OS)
   - получения детальной информации об оффере
-  Использование PHP фреймворков на Ваше усмотрение

# Описание
Был использован фреймворк lumen. Дамп БД находится в корне проекта - [`pliri-task-dump.sql`](https://github.com/lutdev/api-techtask/blob/master/pliri-task-dump.sql). 
Для тестирования работоспособности системы можно воспользоваться докером, если он установлен.

# Запуск проекта
1. Выкачать проект с помощью `git`
```
cd /path/to/project
git clone https://github.com/lutdev/api-techtask.git
```
2. Запустить докер контейнеры
```
cd docker && docker-compose up -d --build
```
3. После инициализации и запуска контейнеров система будет доступна по урлу `http://localhost:8033`
4. В `.env` файлы указать `API_AFFISE_TOKEN` и `API_PLIRI_TOKEN`

# Доступные URL
1. Страницы `http://localhost:8033/affise` и `http://localhost:8033/pliri` выкачивают данные с соответствующих API. Если 
таблица `offers` пустая в БД, она будет заполнена.
2. `GET``http://localhost:8033/api/offers` вернёт список все ID офферов. Роут поддерживает выборку по `status`, `country`,
 `currency`, `advertiser`, `os`. Например, `http://localhost:8033/api/offers?status=active`.
3. `GET` `http://localhost:8033/api/offers/{OFFER_ID}` вернёт информацию по оферу.