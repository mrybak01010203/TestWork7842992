1. Копируем файлы в директорию сервера
2. Устанавливаем версию PHP 7.3 и выше
3. создаем базу данных нименование tz1laravel (если наименование отличается потом необходимо изменять файл .env)
4. Импортируем структуру с данными файл-tz1laravel.sql
5. Создаем пользователя в БД с логином tz1laraveluser и паролем tzLlarPass (если логин и пароль отличается потом необходимо изменять файл .env)
6. Импортируем цепочку в postman из файла tz1laravel.postman_collection.json
7. Тестируем.
8. В микросервере используется простой ключ для доступа. Он по необходимости меняется в файле .env, ключ API_KEY=
9. Используется таблица проектов (projects) с полями название проекта(name), язык(lang) на котором пишется проект. Используется таблица участников с именем(fname) и фамилией (lname). Таблица связей многие ко многим (members_projects) с pivot полем роль(role) в базе введены роли writer, admin. 
10. Запрос формируется методом POST передаются значения
    fname-Имя участника
    lname-Пароль участника
	pname-Наименование проекта
	plang-язык на котором написан проект
	mrole-роль участника
	outorder-сортировка -строки с перечислением полей и тип сортировки по умолчанию сортирует по имени в восходящем, по фамилии нисходящем. Правило имя поля и порядок          сортировки. Пример-fname ASC, lname DESC . Сортировка на данном этапе возможна только по имени и фамилии.
	apikey-ключ доступа должен быть равным LkauGfa7^w23fadr$asdaqwSD52ahgsfdAzsxdQ12&a
11. Путь доступа к данным домен/api/findmembs
    
