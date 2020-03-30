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
