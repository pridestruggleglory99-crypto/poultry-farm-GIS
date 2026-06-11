FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    zip \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd zip pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-interaction --optimize-autoloader

RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan route:clear

RUN npm install
RUN npm run build

CMD php artisan serve --host=0.0.0.0 --port=$PORT