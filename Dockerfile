# Используем официальный образ PHP 8.3 с Apache
FROM php:8.3-fpm AS app

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем необходимые зависимости
RUN apt-get update && \
    apt-get install -y \
    apt-transport-https \
    net-tools \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    unzip \
    curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Устанавливаем необходимые PHP расширения
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    xmlwriter  \
    pcntl

# Установка Node.js
SHELL ["/bin/bash", "-o", "pipefail", "-c"]
RUN apt-get update &&  \
    apt-get install --no-install-recommends -y ca-certificates curl gnupg && \
    mkdir -p /etc/apt/keyrings && \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg && \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_20.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list &&  \
    apt-get update &&  \
    apt-get install --no-install-recommends nodejs -y &&  \
    npm install -g yarn && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Установка Redis
RUN apt-get update && apt-get install -y git autoconf build-essential pkg-config \
    && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
    && docker-php-ext-install redis

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/conf.d/ /usr/local/etc/php/conf.d/

# Права доступа
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

USER www-data:www-data

# Экспонируем порт 9000
EXPOSE 9000
