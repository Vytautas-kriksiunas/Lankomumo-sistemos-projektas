# Lankomumo-sistemos-projektas
projektas Vytauto Krikščiūno Igno Liškaus ir Justinos R.

Nukopijuok .env.example į .env:

command prompt: 
    cp .env.example .env

Sugeneruok aplikacijos raktą:
command prompt: 
    php artisan key:generate

Įdiek priklausomybes:

command prompt: 
    composer install

Sukonfigūruok .env failą (DB prisijungimą)
as naudojau mysql workplace:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=studentai
    DB_USERNAME=root
    DB_PASSWORD=root

Paleisk migracijas:

command prompt: 
    php artisan migrate

Sugeneruok duomenys DB:
    php artisan migrate:fresh --seed
