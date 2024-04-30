FROM php:8.2.4-fpm-alpine

# Diretorio da aplicacao
WORKDIR /var/www/html

# copia todos arquivos para a imagem
COPY . .
COPY php.ini /usr/local/etc/php/php.ini

# Instala extensoes
RUN docker-php-ext-install pdo_mysql mysqli exif pcntl

# Instala composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/html/


run docker-php-ext-install pdo pdo_mysql mysqli exif pcntl

run composer update
# Inicia instancia Laravel
CMD ["sh", "-c", "php -S 0.0.0.0:8000 -t /var/www/html/public"]
