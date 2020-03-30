Развертывание сайта:
в папке доменов создать проект larover 

    composer create-project laravel/laravel agilo
    
установить допонительно bootstrap, jquery

    npm install bootstrap --save-dev
    
    npm install jquery --save-dev
    
установить дополнительно
    composer require laravel/ui
    
скачать архивом файлы пректа 
    wget https://github.com/alexKostomarov/agilo/archive/master.zip
    
распаковать архив в папке проекта(подтвердить перезапись файлов)

выполнить настройки в .env

после того, как будет настроена бд
выполнить миграции
        php artisan migrate
        
 залить в базу дамп с таблицей пользоватеоей agilo.sql. В таблице один пользовтель-менеджер(login:alex@w-online.ru, password:12345678). 
 В случае mysql так:
        mysql -u user -p < agilo.sql
        
 Для доступа к приложенным к заявке файлом надо в папке public сделать симлинк на storage
        php artisan storage:link
        
        

    
  
