## Comandos necesarios para poder usar mongoDB con Laravel 

apt-get update
apt-get install -y autoconf php-dev
pecl install mongodb


Luego de esto, hay que añadir la linea "extension=mongodb.so" en el fichero php.ini global.
Esto lo hemos hecho abriendo la terminal shell del contenedor de Laravel, nos dirigimos a la ruta opt/bitnami/php/lib y alli ejecutamos :
echo "extension=mongodb.so" >>  php.ini

Finalmente, ejecutamos : 

composer require mongodb/laravel-mongodb
