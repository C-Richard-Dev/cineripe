# Imagem base do PHP com extensões necessárias
FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Gera cache das configurações do Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Define o comando padrão
CMD php artisan serve --host=0.0.0.0 --port=$PORT

# Expõe a porta 8080
EXPOSE 8080
