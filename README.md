# Зоопарк — практическая работа Docker + PHP + MySQL

Проект по «Копия docker_dbeaver.docx»: таблица животных из базы zoo_db. Подключение и index.php повторяют пример задания. Записи идут по ID по убыванию. Данные изменяются в DBeaver.

## Запуск

```powershell
cd D:\Docker\docker-zoo-practice
docker compose up -d --build
docker compose ps
```

Откройте http://localhost:8000/. Контейнеры: zoo_nginx, zoo_php, zoo_mysql. В .env: MYSQL_ROOT_PASSWORD=root и MYSQL_DATABASE=zoo_db.

## Импорт дампа при первом запуске

В Git Bash из папки проекта:

```bash
docker compose exec -T mysql mysql -u root -proot zoo_db < dump/zoo_db_dump.sql
```

В PowerShell:

```powershell
docker compose cp dump/zoo_db_dump.sql mysql:/tmp/zoo_db_dump.sql
docker compose exec -T mysql mysql -u root -proot zoo_db -e "SOURCE /tmp/zoo_db_dump.sql"
```

Импорт нужен для пустой базы. Повторный импорт заменяет таблицы текущими данными из дампа. Существующие данные при переделке проекта сохранены.

## Проверка

```powershell
docker compose exec mysql mysql -u root -proot zoo_db -e "SELECT COUNT(*) AS cnt FROM animals; SHOW TABLES;"
```

## DBeaver

MySQL: localhost, порт 3307, база zoo_db, пользователь root, пароль root. Для подключения по TLS можно задать свойство драйвера sslMode=REQUIRED. Откройте SQL-редактор и выполните:

```sql
SELECT a.name AS animal, s.name AS species, e.name AS enclosure
FROM animals a
JOIN species s ON a.species_id = s.id
JOIN enclosures e ON a.enclosure_id = e.id;
```

Покажите преподавателю три контейнера, таблицу в браузере и SQL в DBeaver.

## Структура

Файлы приложения: src/config/db.php, src/index.php, src/style.css. src/add.php и src/edit.php оставлены как заготовки из структуры методички — кода для них в документе нет. Дополнительных форм и действий на странице нет. CSS содержит только границы и отступы таблицы; в документе содержимое style.css не приведено.

Git remote: git@github.com:mkzvcode/docker-zoo-practice.git. .gitignore отсутствует согласно запросу. Порты доступны через localhost. Имя Compose-проекта сохранено, чтобы использовать прежний том базы.
